<template>
  <div>
    <div class="container-content">
      <div class="content-title-bar">
        <input type="button" value="Add Category" class="btn add-new" data-toggle="modal" data-target="#createCategory">
        <div class="search-input-container">
          <input type="text" class="textbox" placeholder="Search" v-model="categories_search">
        </div>
      </div>

      <section class="card-container">
        <div class="card-row">
          <div class="card-wrap" v-for="category in filteredCategories" :key="category.id">
            <router-link to="/admin_inventory_2" class="card-link">
              <div class="card" @click="getCategory(category)">
                <div class="card-body">
                  <h4 class="card-title">{{category.category_description}}</h4>
                </div>
              </div>
            </router-link>
          </div>
        </div>
      </section>
    </div>
      
    <div class="modal fade" data-backdrop="static" id="createCategory">
      <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
  
          <div class="modal-header">
            <h3 class="modal-title">Add Category</h3>
          </div>
  
          <div class="modal-body">
            <form>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <input type="text" class="form-control" v-model="category_description" placeholder="Category Name">
                  </div>
                </div>
              </div>
  
            </form>
          </div>
  
          <div class="modal-footer">
            <a class="btn btn-primary" @click="createCategories">Create</a>
            <button type="button" class="btn" data-dismiss="modal" @click="clear">Cancel</button>
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
      this.$store.commit('setNavbar', 'Inventory');
      this.$store.commit('setButton', 'inventory');
    },
    mounted(){
      this.$store.dispatch('fetchCategories');
    },
    data(){
      return{
          categories_search:'',
          category_id: 0,
          category_title:"",
          category_description:"",
          componentKey: this.$store.state.componentKey,
      }
    },
    computed:{
      ...mapGetters({
        categories: "getCategories",
      }),

      filteredCategories() {
        let tempCategories = this.categories

        if (this.categories_search != '' && this.categories_search) {
        tempCategories = tempCategories.filter((category) => {
          return category.category_description
            .toUpperCase()
            .includes(this.categories_search.toUpperCase())
          })
        }
        else{
          tempCategories = tempCategories.filter((category) => {
            return (category.category_description)
          })
        }

        return tempCategories;
      }
    },

    methods:{
    createCategories(){
      var data = {
        category_description: this.category_description,
      };
      
      this.$store.dispatch('createCategories', data);

      this.componentKey += 1;
      this.$store.commit("setAdminLogin", false);
      this.$nextTick(() => {
        this.$store.commit("setAdminLogin", true);
      });
      setTimeout(() => {
        this.$store.commit("setComponentKey", this.componentKey);
      }, 800);
      $('#createCategory').modal('hide');
      this.$toast.success("Category Added Successfuly!");
      this.clear();
    },

    clear(){
      this.category_description = "";
    },

    getCategory(category){
      this.category_id = category.id;
      this.category_title = category.category_description;

      this.$store.commit('setCategoryId', this.category_id);
      this.$store.commit('setCatgoryTitle', this.category_title);
    },
  }

  };
</script>
