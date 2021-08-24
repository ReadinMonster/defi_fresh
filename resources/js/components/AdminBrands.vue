<template>
  <div>
    <div class="container-content">
      <div class="content-title-bar">
        <input type="button" value="Add Brand" class="btn add-new" data-toggle="modal" data-target="#createBrand">
        <div class="search-input-container">
          <input type="text" class="textbox" placeholder="Search" v-model="brands_search">
        </div>
      </div>

      <div class="tables">
          <table>
            <thead>
              <tr>
                <td>ID Number</td>
                <td>Brand Name</td>
                <td></td>
              </tr>
            </thead>

            <tbody v-for="brand in filteredBrands" :key="brand.id">
              <tr>
                <td>{{brand.id}}</td>
                <td>{{brand.brand_description}}</td>
                <td>
                  <button class="btn-edit btn" data-toggle="modal" data-target="#editBrand" @click="editBrand(brand)">Edit</button>
                </td>
              </tr>

            </tbody>
            
          </table>
      </div>
    </div>
    
    <div class="modal fade" data-backdrop="static" id="createBrand">
      <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
  
          <div class="modal-header">
            <h3 class="modal-title">Add Brand</h3>
          </div>
  
          <div class="modal-body">
            <form>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <input type="text" class="form-control" v-model="brand.brand_description" placeholder="Brand Name">
                  </div>
                </div>
              </div>
  
            </form>
          </div>
  
          <div class="modal-footer">
            <a class="btn btn-primary" @click="createBrands">Create</a>
            <button type="button" class="btn" data-dismiss="modal" @click="clear">Cancel</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" data-backdrop="static" id="editBrand">
      <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
  
          <div class="modal-header">
            <h3 class="modal-title">Edit Brand</h3>
          </div>
  
          <div class="modal-body">
            <form>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <input type="text" class="form-control" v-model="edit.edit_description" placeholder="Brand Name">
                  </div>
                </div>
              </div>
  
            </form>
          </div>
  
          <div class="modal-footer">
            <a class="btn btn-primary" @click="updateBrand">Save</a>
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
      this.$store.commit('setNavbar', 'Brands');
      this.$store.commit('setButton', 'brands');
    },
    mounted(){
      this.$store.dispatch('fetchBrands');
    },
    data(){
      return{
          brands_search:'',
          brand:{
            brand_description:"",
          },
          edit:{
            edit_id:"",
            edit_description:"",
          },
          componentKey: this.$store.state.componentKey,
      }
    },
    computed:{
      ...mapGetters({
        brands: "getBrands",
      }),

      filteredBrands() {
        return this.brands.filter(brand => {
          return (
            brand.brand_description.match(this.brand_search)
          );
        });
      }
    },

  methods:{
    createBrands(){
      var data = {
        brand_description: this.brand.brand_description,
      };
      
      this.$store.dispatch('createBrands', data);

      this.componentKey += 1;
      this.$store.commit("setAdminLogin", false);
      this.$nextTick(() => {
        this.$store.commit("setAdminLogin", true);
      });
      setTimeout(() => {
        this.$store.commit("setComponentKey", this.componentKey);
      }, 800);
      $('#createBrand').modal('hide');
      this.$toast.success("Brand Added Successfuly!");
      this.clear();
    },

    editBrand(brand){
      this.edit.edit_id = brand.id,
      this.edit.edit_description = brand.brand_description
    },

    updateBrand(){
      var data = {
        id: this.edit.edit_id,
        brand_description: this.edit.edit_description,
      };

      this.$store.dispatch('updateBrands', data);

      this.componentKey += 1;
      this.$store.commit("setAdminLogin", false);
      this.$nextTick(() => {
        this.$store.commit("setAdminLogin", true);
      });
      setTimeout(() => {
        this.$store.commit("setComponentKey", this.componentKey);
      }, 800);
      $('#editBrand').modal('hide');
      this.$toast.success("Brand Updated Successfuly!");
      this.clear();
    },

    clear(){
      this.brand.brand_description = "";
    }
  }

  };
</script>

