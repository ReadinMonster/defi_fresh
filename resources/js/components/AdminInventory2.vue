<template>
  <div class="tables-container">

    <div class="content-title-bar">
      <span v-text="category_title"></span>
      <div class="search-input-container">
        <input type="text" class="textbox" v-model="product_search" placeholder="Search" >
      </div>
    </div>

    <div class="tables">
      <table>
        <thead>
          <tr>
            <td>Product ID</td>
            <td>Product Name</td>
            <td>Quantity</td>
            <td>Price</td>
          </tr>
        </thead>

        <tbody v-for="product in filteredProducts" :key="product.id">
          <tr>
            <td>{{product.id}}</td>
            <td>{{product.product_name}}</td>
            <td>{{product.product_quantity}}</td>
            <td>{{product.product_price}}</td>
          </tr>

        </tbody>
        
      </table>
    </div>

  </div>
</template>

<script>
  import { mapGetters } from "vuex";

  export default {
    data(){
      return{
        category_id: this.$store.state.category_id,
        category_title: this.$store.state.category_title,
        product_search: '',
        componentKey: this.$store.state.componentKey,
      }
    },
    mounted(){
      this.$store.dispatch('fetchProducts');
    },
    computed:{
      ...mapGetters({
        products: "getProducts",
      }),

      filteredProducts() {
        let tempProducts = this.products

        if (this.product_search != '' && this.product_search) {
        tempProducts = tempProducts.filter((product) => {
          return product.product_name
            .toUpperCase()
            .includes(this.product_search.toUpperCase())
          })
        }
        else{
          tempProducts = tempProducts.filter((product) => {
            return (product.category_id === this.category_id)
          })
        }

        return tempProducts;
      }
    },
  }
</script>

