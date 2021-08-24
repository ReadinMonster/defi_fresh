<template>
  <div class="container-content">
    <div class="content-title-bar">
      <span>Categories</span>
      <div class="search-input-container">
        <input type="text" class="textbox" v-model=" categories_search" placeholder="Search">
      </div>
    </div>

    <section class="card-container">
      <div class="card-row">
        <div class="card-wrap" v-for="category in filteredCategories" :key="category.id">
          <router-link to="/employee_dashboard_2" class="card-link">
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
</template>

<script>

  import { mapGetters } from "vuex";

  export default {
    beforeCreate: function(){
      this.$store.commit('setNavbar', 'Inventory');
    },
     mounted(){
      this.$store.dispatch('fetchCategories');
    },
    data(){
      return{
          categories_search:'',
          category_id: 0,
          category_title:"",
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

    getCategory(category){
      this.category_id = category.id;
      this.category_title = category.category_description;

      this.$store.commit('setCategoryId', this.category_id);
      this.$store.commit('setCatgoryTitle', this.category_title);
      this.$store.commit('setNavbar', this.category_title);
    },
  }
  };
</script>