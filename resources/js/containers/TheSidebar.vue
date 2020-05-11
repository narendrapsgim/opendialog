<template>
  <CSidebar
    fixed
    :minimize="minimize"
    :show="show"
  >
    <CSidebarBrand class="d-md-down-none" to="/admin">
      <img class="c-sidebar-brand-full" src="/images/logo.svg" width="63" height="25" alt="Opendialog Logo">
      <span class="c-sidebar-brand-full">Opendialog</span>
      <img class="c-sidebar-brand-minimized" src="/images/logo.svg" width="30" height="30" alt="Opendialog Logo">
    </CSidebarBrand>

    <CRenderFunction flat :content-to-render="nav"/>
    <CSidebarMinimizer
      class="d-md-down-none"
      @click.native="minimize = !minimize"
    />
  </CSidebar>
</template>

<script>
export default {
  name: 'TheSidebar',
  props: ['show'],
  data() {
    return {
      minimize: false,
      nav: [],
    };
  },
  computed: {
    navigationItems() {
      return window.NavigationItems;
    },
  },
  created() {
    this.buildSidebarMenu();
  },
  methods: {
    buildSidebarMenu() {
      const navItems = [];

      this.asyncForEach(this.navigationItems, async (item) => {
        const navigationItem = {
          _name: 'CSidebarNavItem',
          name: item.title,
          to: item.url,
          icon: item.icon,
        };

        if (item.children) {
          if (Array.isArray(item.children)) {
            navigationItem._children = item.children;
          } else {
            navigationItem._children = await this.getChildren(item.children);
          }
        }

        navItems.push(navigationItem);
      });

      this.nav = [{ _name: 'CSidebarNav', _children: navItems }];
    },
    async getChildren(url) {
      const promise = axios.get(url).then(
        (response) => {
          return response.data;
        },
      );

      return await Promise.resolve(promise);
    },
    async asyncForEach(array, callback) {
      for (let index = 0; index < array.length; index++) {
        await callback(array[index], index, array);
      }
    },
  },
};
</script>
