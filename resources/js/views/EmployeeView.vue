<template>
  <div class="body-wrapper">
  
    <employee-sidebar></employee-sidebar>

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
    },
    computed: {
      title() {
        return this.$store.state.activeNavbar;
      }
    }
  }
</script>
