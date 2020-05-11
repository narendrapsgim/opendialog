<template>
  <CHeader fixed with-subheader light>
    <CToggler
      in-header
      class="ml-3 d-lg-none"
      @click="$emit('toggleSidebar')"
    />
    <CToggler
      in-header
      class="ml-3 d-md-down-none"
      @click="$emit('toggleSidebar')"
    />
    <CHeaderBrand class="mx-auto d-lg-none" to="/">
      <CIcon name="logo" height="48" alt="Logo"/>
    </CHeaderBrand>
    <CHeaderNav class="d-md-down-none mr-auto">
      <CHeaderNavItem class="px-3" v-for="item in navigationItems" :key="item.url">
        <CHeaderNavLink :to="item.url">
          {{ item.title }}
        </CHeaderNavLink>
      </CHeaderNavItem>
    </CHeaderNav>
    <CHeaderNav>
      <TheHeaderDropdownAccnt/>
    </CHeaderNav>
  </CHeader>
</template>

<script>
import TheHeaderDropdownAccnt from './TheHeaderDropdownAccnt';

export default {
  name: 'TheHeader',
  components: {
    TheHeaderDropdownAccnt,
  },
  computed: {
    navigationItems() {
      return window.NavigationItems;
    },
  },
};
</script>
