<template>
  <div class="body-wrapper">
  
    <admin-sidebar :activeBtn="button"></admin-sidebar>

    <div class="content">
      <navbar v-bind:navbarTitle="title"></navbar>

      <router-view></router-view>

    </div>

  </div>
</template>

<script>
  export default {
    beforeCreate: function(){
      this.$store.commit('setNavbar', 'Inventory');
      this.$store.commit('setButton', 'inventory');
    },
    computed: {
      title() {
        return this.$store.state.activeNavbar;
      },
      button() {
        return this.$store.state.activeButton;
      }
    }
  }
</script>