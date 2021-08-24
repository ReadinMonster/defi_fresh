<template>
  <div>
      <div class="container-content">
        <div class="content-title-bar">
          <input type="button" value="Add Supplier" class="btn add-new" data-toggle="modal" data-target="#createSupplier">
          <div class="search-input-container">
            <input type="text" class="textbox" placeholder="Search" v-model="suppliers_search">
          </div>
        </div>

        <div class="tables">
          <table>
            <thead>
              <tr>
                <td>Supplier ID</td>
                <td>Company Name</td>
                <td></td>
              </tr>
            </thead>

            <tbody v-for="supplier in filteredSuppliers" :key="supplier.id">
              <tr>
                <td>{{supplier.id}}</td>
                <td>{{supplier.supplier_name}}</td>
                <td>
                  <button class="btn-edit btn" data-toggle="modal" data-target="#editSupplier" @click="editSupplier(supplier)">Edit</button>
                </td>
              </tr>

            </tbody>
            
          </table>
        </div>        
      </div>
        
      <div class="modal fade" data-backdrop="static" id="createSupplier">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
          <div class="modal-content">
    
            <div class="modal-header">
              <h3 class="modal-title">Add Supplier</h3>
            </div>
    
            <div class="modal-body">
              <form>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-12">
                      <input type="text" class="form-control" v-model="supplier.supplier_name" placeholder="Company Name">
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="row">
                    <div class="col-md-12">
                      <input type="number" class="form-control" v-model="supplier.supplier_contact_number" placeholder="Contact Number">
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="row">
                    <div class="col-md-12">
                      <input type="text" class="form-control" v-model="supplier.supplier_address" placeholder="Address">
                    </div>
                  </div>
                </div>
                
              </form>
            </div>
    
            <div class="modal-footer">
              <a class="btn btn-primary" @click="createSuppliers">Create</a>
              <button type="button" class="btn" data-dismiss="modal" @click="clear">Cancel</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" data-backdrop="static" id="editSupplier">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
          <div class="modal-content">
    
            <div class="modal-header">
              <h3 class="modal-title">Edit Supplier</h3>
            </div>
    
            <div class="modal-body">
              <form>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-12">
                      <input type="text" class="form-control" v-model="edit.edit_name" placeholder="Company Name">
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="row">
                    <div class="col-md-12">
                      <input type="text" class="form-control" v-model="edit.edit_contact_number" placeholder="Contact Number">
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="row">
                    <div class="col-md-12">
                      <input type="text" class="form-control" v-model="edit.edit_address" placeholder="Address">
                    </div>
                  </div>
                </div>
                
              </form>
            </div>
    
            <div class="modal-footer">
              <a class="btn btn-primary" @click="updateSupplier">Save</a>
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
      this.$store.commit('setNavbar', 'Suppliers');
      this.$store.commit('setButton', 'suppliers');
    },
    mounted(){
      this.$store.dispatch('fetchSuppliers');
    },
    data(){
      return{
          suppliers_search:'',
          supplier:{
            supplier_name:"",
            supplier_contact_number:"",
            supplier_address:"",
          },
          edit:{
            edit_id:"",
            edit_name:"",
            edit_contact_number:"",
            edit_address:"",
          },
          componentKey: this.$store.state.componentKey,
      }
    },
    computed:{
      ...mapGetters({
        suppliers: "getSuppliers",
      }),

      filteredSuppliers() {
        return this.suppliers.filter(supplier => {
          return (
            supplier.supplier_name.match(this.suppliers_search)
          );
        });
      }
    },

    methods:{

    createSuppliers(){
      var data = {
          supplier_name: this.supplier.supplier_name,
          supplier_contact_number: this.supplier.supplier_contact_number,
          supplier_address: this.supplier.supplier_address,
      };
      
      this.$store.dispatch('createSupplier', data);

      this.componentKey += 1;
      this.$store.commit("setAdminLogin", false);
      this.$nextTick(() => {
        this.$store.commit("setAdminLogin", true);
      });
      setTimeout(() => {
        this.$store.commit("setComponentKey", this.componentKey);
      }, 800);
      $('#createSupplier').modal('hide');
      this.$toast.success("Supplier Added Successfuly!");
      this.clear();
    },

    editSupplier(supplier){
      this.edit.edit_id = supplier.id;
      this.edit.edit_name = supplier.supplier_name;
      this.edit.edit_contact_number = supplier.supplier_contact_number;
      this.edit.edit_address = supplier.supplier_address;
    },

    updateSupplier(){
      var data = {
        id: this.edit.edit_id,
        supplier_name:  this.edit.edit_name,
        supplier_contact_number:  this.edit.edit_contact_number,
        supplier_address: this.edit.edit_address,
      };

      this.$store.dispatch('updateSupplier', data);

      this.componentKey += 1;
      this.$store.commit("setAdminLogin", false);
      this.$nextTick(() => {
        this.$store.commit("setAdminLogin", true);
      });
      setTimeout(() => {
        this.$store.commit("setComponentKey", this.componentKey);
      }, 800);
      $('#editSupplier').modal('hide');
      this.$toast.success("Supplier Updated Successfuly!");
      this.clear();
    },

    clear(){
        this.supplier.supplier_name = "";
        this.supplier.supplier_contact_number = "";
        this.supplier.supplier_address = "";
    }
  }

};
</script>