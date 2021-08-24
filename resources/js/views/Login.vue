<template>
  <div>
    <div class="login-wrapper">
  
      <div>
        <img src="/assets/full-logo.png">
      </div>

      <div class="container-fluid login-content">
        <form class="login-form">
          <h1>Log In</h1>
          <div class="row"><input type="text" placeholder="Email" class="login-input" v-model="input.email"></div>
          <div class="row"><input type="password" placeholder="Password" class="login-input" v-model="input.password"></div>
          <div class="row">
              <button class="login-button" @click.prevent="authenticateUser">Log In</button>
          </div>
        </form>
      </div>

    </div>
  </div>
</template>

<script>
  import { mapGetters } from "vuex";

  export default {
    mounted(){
      this.$store.dispatch('fetchUsers');
    },
     data(){
      return{
        input: {
          email:"",
          password:"",
        },      
      }
    },
    computed:{
      ...mapGetters({
        users: "getUsers",
      }),
      userInfo(){
        let tempUsers = this.users;
        const foundDoctor = tempUsers.find(x => x.email === this.input.email); 
        return foundDoctor || 0;
      }
    },
    methods: {
      authenticateUser(){
        let userAuthentication = this.userInfo;

        if(userAuthentication == 0){
          this.$toast.error("Invalid username");
          this.clear();
        }
        else
        {
          if(userAuthentication.password === this.input.password){
            if(userAuthentication.position === "Admin"){
              this.loginAdmin();
              this.$toast.success("Welcome " + userAuthentication.first_name);
            }
            else{
              this.loginEmployee();
              this.$toast.success("Welcome " + userAuthentication.first_name);
            }
              let name = userAuthentication.first_name;
              this.$store.commit('setUserName', name);
              this.$store.commit('setUserEmail', userAuthentication.email);
              this.$store.commit('setUserPassword', userAuthentication.password);
          }
          else{
            this.$toast.error("Invalid password");
            this.clear();
          }
        }
        
      },
      loginAdmin() {
        this.$store.commit('setAdminLogin', true);
        this.$router.push('/admin_inventory_1');
      },
      loginEmployee() {
        this.$store.commit('setEmployeeLogin', true);
        this.$router.push('/employee_dashboard');
      },
      clear(){
        this.input.email="";
        this.input.password="";
      }
    }
  }
</script>