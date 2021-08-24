<template>
  <div>
    <div class="container-content">
      <div class="content-title-bar">
        <input type="button" value="Add Employee" class="btn add-new" data-toggle="modal" data-target="#createUser">
        <div class="search-input-container">
          <input type="text" class="textbox" v-model="user_search" placeholder="Search">
        </div>
      </div>

      <div class="tables">
          <table>
            <thead>
              <tr>
                <td>ID Number</td>
                <td>Name</td>
                <td>Position</td>
                <td></td>
              </tr>
            </thead>

            <tbody v-for="user in filteredUsers" :key="user.id">
              <tr>
                <td>{{user.id}}</td>
                <td>{{user.last_name + ", " + user.first_name}}</td>
                <td>{{user.position}}</td>
                <td>
                  <button class="btn-delete btn" data-toggle="modal" data-target="#deleteUser" @click="retreiveId(user.id)">Delete</button>
                  <button class="btn-edit btn" data-toggle="modal" data-target="#editUser" @click="editUser(user)">Edit</button>
                </td>
              </tr>

            </tbody>
            
          </table>
      </div>
    </div>
      
    <div class="modal fade" data-backdrop="static" id="createUser">
      <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
  
          <div class="modal-header">
            <h3 class="modal-title">Add Employee</h3>
          </div>
  
          <div class="modal-body">
            <form>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <input type="text" class="form-control" v-model="user.first_name" placeholder="First Name">
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <input type="text" class="form-control" v-model="user.middle_name" placeholder="Middle Name">
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <input type="text" class="form-control" v-model="user.last_name" placeholder="Last Name">
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <select v-model="user.position">
                      <option value="Admin">Admin</option>
                      <option value="Employee">Employee</option>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <select v-model="user.sex">
                      <option value="female">Female</option>
                      <option value="male">Male</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <input type="text" class="form-control" v-model="user.email" placeholder="Email">
                  </div>
                </div>
              </div>
  
            </form>
          </div>
  
          <div class="modal-footer">
            <a  class="btn btn-primary" @click="createUsers">Create</a>
            <button type="button" class="btn" data-dismiss="modal" @click="clear">Cancel</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" data-backdrop="static" id="editUser">
      <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
  
          <div class="modal-header">
            <h3 class="modal-title">Edit Employee</h3>
          </div>
  
          <div class="modal-body">
            <form>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <input type="text" class="form-control" v-model="edit.first_name" placeholder="First Name">
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <input type="text" class="form-control" v-model="edit.middle_name" placeholder="Middle Name">
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <input type="text" class="form-control" v-model="edit.last_name" placeholder="Last Name">
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <select v-model="edit.position">
                      <option value="Admin">Admin</option>
                      <option value="Employee">Employee</option>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <select v-model="edit.sex">
                      <option value="female">Female</option>
                      <option value="male">Male</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <input disabled type="text" class="form-control" v-model="edit.email" placeholder="Email">
                  </div>
                </div>
              </div>
  
            </form>
          </div>
  
          <div class="modal-footer">
            <a class="btn btn-primary" @click="updateUser">Save</a>
            <button type="button" class="btn" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" data-backdrop="static" id="deleteUser">
      <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">

          <div class="modal-header">
            <h3 class="modal-title">Delete Employee</h3>
          </div>

          <div class="modal-body">
            <h5>Remove employee permanently?</h5>
          </div>

          <div class="modal-footer">
            <a class="btn btn-danger" @click="deleteUser">Delete</a>
            <button type="button" class="btn" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>
    </div>

  </div>
</template>


<script>
  import { mapGetters } from "vuex";

  export default {
    beforeCreate: function(){
      this.$store.commit('setNavbar', 'Employees');
      this.$store.commit('setButton', 'employee');
    },
    mounted(){
      this.$store.dispatch('fetchUsers');
    },
    data(){
      return{
          user_search:'',
          user:{
            first_name:"",
            middle_name:"",
            last_name:"",
            position:"",
            sex:"",
            email:"",
            password:"",
          },
          edit:{
            id: "",
            first_name:"",
            middle_name:"",
            last_name:"",
            position:"",
            sex:"",
            email:"",
          },
          componentKey: this.$store.state.componentKey,
          deleteId: 0,
      }
    },
    computed:{
      ...mapGetters({
        users: "getUsers",
      }),

      filteredUsers() {
      
        let tempUsers = this.users;

        if (this.user_search != '' && this.user_search) {
        tempUsers = tempUsers.filter((user) => {
          return user.first_name
            .toUpperCase()
            .includes(this.user_search.toUpperCase()) ||
            user.last_name
            .toUpperCase()
            .includes(this.user_search.toUpperCase()) ||
            user.position
            .toUpperCase()
            .includes(this.user_search.toUpperCase())
          })
        }

        return tempUsers;
      }
    },

    methods:{

    createUsers(){
      var data = {
          first_name: this.user.first_name,
          middle_name: this.user.middle_name,
          last_name: this.user.last_name,
          position: this.user.position,
          sex: this.user.sex,
          email: this.user.email,
          password: this.user.last_name + "123",
      };
      
      this.$store.dispatch('createUser', data);

      this.componentKey += 1;
      this.$store.commit("setAdminLogin", false);
      this.$nextTick(() => {
        this.$store.commit("setAdminLogin", true);
      });
      setTimeout(() => {
        this.$store.commit("setComponentKey", this.componentKey);
      }, 800);
      $('#createUser').modal('hide');
      this.$toast.success("User Added Successfuly!");
      this.clear();
    },

    editUser(user){
      this.edit.id = user.id;
      this.edit.first_name = user.first_name;
      this.edit.middle_name = user.middle_name;
      this.edit.last_name = user.last_name;
      this.edit.position = user.position;
      this.edit.sex = user.sex;
      this.edit.email = user.email;
    },

    updateUser(){
      var data = {
        id: this.edit.id,
        first_name: this.edit.first_name, 
        middle_name: this.edit.middle_name,
        last_name: this.edit.last_name,
        position: this.edit.position,
        sex: this.edit.sex,
        email: this.edit.email,
      };

      this.$store.dispatch('updateUser', data);

      this.componentKey += 1;
      this.$store.commit("setAdminLogin", false);
      this.$nextTick(() => {
        this.$store.commit("setAdminLogin", true);
      });
      setTimeout(() => {
        this.$store.commit("setComponentKey", this.componentKey);
      }, 800);
      $('#editUser').modal('hide');
      this.$toast.success("User Updated Successfuly!");
      this.clear();
    },

    deleteUser() {

      this.$store.dispatch('deleteUser', this.deleteId);

      this.componentKey += 1;
      this.$store.commit("setAdminLogin", false);
      this.$nextTick(() => {
        this.$store.commit("setAdminLogin", true);
      });
      setTimeout(() => {
        this.$store.commit("setComponentKey", this.componentKey);
      }, 800);
      $('#deleteUser').modal('hide');
      this.$toast.error("User removed successfuly!");
      this.clear();
    },

    retreiveId(id) {
      this.deleteId = id;
    },

    clear(){
      this.user.first_name = "";
      this.user.middle_name = "";
      this.user.last_name ="";
      this.user.position = "";
      this.user.sex = "";
      this.user.email = "";
    }
  }

};
</script>
