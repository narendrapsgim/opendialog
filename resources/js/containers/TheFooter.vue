<template>
  <CFooter :fixed="false">
    <div>
      <a href="https://opendialog.ai">OpenDialog</a>
      <span class="ml-1">&copy; {{ new Date().getFullYear() }} Greenshoot Labs.</span>
    </div>
  </CFooter>
</template>

<script>
export default {
  name: 'TheFooter',
};
</script>
