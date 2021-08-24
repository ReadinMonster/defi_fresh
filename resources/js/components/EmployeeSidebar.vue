<template>
  <div>
    <nav class="sidebar">
      <div class="sidebar-logo">
        <img src="/assets/icon-logo.png">
      </div>

      <div class="sidebar-name-container">
        <span class="sidebar-name" v-text="user_name"></span>
      </div>  

      <ul class="list-unstyled">
        <router-link to="/employee_dashboard">
          <li class="active">
            <span>Inventory</span>
          </li>
        </router-link>

      </ul>
    </nav>

    
  </div>
</template>

<script>
    export default {
      data(){
        return{
          user_name: this.$store.state.user_name,
        }
      },
    }
</script>
