<template>
  <div>
    <div class="container-content">
        <div class="content-title-bar">
          <input type="button" value="Add Product" class="btn add-new" data-toggle="modal" data-target="#createProduct">
        </div>

        <div class="tables">
          <table>
            <thead>
              <tr>
                <td>Product ID</td>
                <td>Product Name</td>
                <td>Quantity</td>
                <td>Price</td>
                <td></td>
              </tr>
            </thead>

            <tbody v-for="product in filteredProducts" :key="product.id">
              <tr>
                <td>{{product.id}}</td>
                <td>{{product.product_name}}</td>
                <td>{{product.product_quantity}}</td>
                <td>Php {{product.product_price}}</td>
                <td>
                  <button class="btn-delete btn" data-toggle="modal" data-target="#deleteProduct" @click="retreiveId(product.id)">Delete</button>
                  <button class="btn-edit btn" data-toggle="modal" data-target="#editProduct" @click="editProduct(product)">Edit</button>
                </td>
              </tr>

            </tbody>
            
          </table>
        </div>
    </div>
    
    <div class="modal fade" data-backdrop="static" id="createProduct">
      <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
  
          <div class="modal-header">
            <h3 class="modal-title">Add Product</h3>
          </div>
  
          <div class="modal-body">
            <form>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <input type="text" class="form-control" v-model="product.product_name" placeholder="Product Name">
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <select>
                      <option disabled selected>
                        {{this.category_title}}
                      </option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <select v-model="product.supplier_name">
                      <option selected disabled>SUPPLIER</option>
                      <option v-for="supplier in suppliers" :key="supplier.id">
                        {{supplier.supplier_name}}
                      </option>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <select v-model="product.brand_description">
                      <option selected disabled>BRAND</option>
                      <option v-for="brand in brands" :key="brand.id">
                        {{brand.brand_description}}
                      </option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <input type="text" class="form-control" v-model="product.product_quantity" placeholder="Quantity">
                  </div>
                  <div class="col-md-6">
                    <input type="text" class="form-control" v-model="product.product_price" placeholder="Price">
                  </div>
                </div>
              </div>
              
            </form>
          </div>
  
          <div class="modal-footer">
            <a class="btn btn-primary" @click="createProducts">Create</a>
            <button type="button" class="btn" data-dismiss="modal" @click="clear">Cancel</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" data-backdrop="static" id="editProduct">
      <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
  
          <div class="modal-header">
            <h3 class="modal-title">Edit Product</h3>
          </div>
  
          <div class="modal-body">
            <form>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <input type="text" class="form-control" v-model="edit.product_name" placeholder="Product Name">
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <select>
                      <option>{{this.category_title}}</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <select v-model="edit.supplier_name">
                      <option v-for="supplier in suppliers" :key="supplier.id">
                        {{supplier.supplier_name}}
                      </option>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <select v-model="edit.brand_description">
                      <option v-for="brand in brands" :key="brand.id">
                        {{brand.brand_description}}
                      </option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <input type="text" class="form-control" v-model="edit.product_quantity" placeholder="Quantity">
                  </div>
                  <div class="col-md-6">
                    <input type="text" class="form-control" v-model="edit.product_price" placeholder="Price">
                  </div>
                </div>
              </div>
              
            </form>
          </div>
  
          <div class="modal-footer">
            <a  class="btn btn-primary" @click="updateProduct">Save</a>
            <button type="button" class="btn" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" data-backdrop="static" id="deleteProduct">
      <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">

          <div class="modal-header">
            <h3 class="modal-title">Delete Product</h3>
          </div>

          <div class="modal-body">
            <h5>Remove product permanently?</h5>
          </div>

          <div class="modal-footer">
            <a class="btn btn-danger" @click="deleteProduct">Delete</a>
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
    data(){
      return{
        category_id: this.$store.state.category_id,
        category_title: this.$store.state.category_title,
        product_search: '',
        product:{
          supplier_id: 0,
          brand_id: 0,
          supplier_name: "",
          brand_description: "",
          product_name: "",
          product_quantity: "",
          product_price: ""  
        },
        edit:{
          id: 0,
          supplier_id: 0,
          brand_id: 0,
          supplier_name: "",
          brand_description: "",
          product_name: "",
          product_quantity: "",
          product_price: "",
        },
        componentKey: this.$store.state.componentKey,
        editValue: "",
        deleteId: 0,
      }
    },
    mounted(){
      this.$store.dispatch('fetchProducts');
      this.$store.dispatch('fetchSuppliers');
      this.$store.dispatch('fetchBrands');
      this.$store.commit('setNavbar', this.category_title);
    },
    computed:{
      ...mapGetters({
        products: "getProducts",
        categories: "getCategories",
        suppliers: "getSuppliers",
        brands: "getBrands",
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
      },
      
      filteredCatgeories() {
        let tempCategories = this.categories

        tempCategories = tempCategories.filter((category) => {
          return (category.category_description)
        })
        
        return tempProducts;
      },
    },

    methods: {

    createProducts(){
      this.editValue = false;

      this.retreiveSupplierId();
      this.retreiveBrandId();

      var data = {
        category_id: this.category_id,
        supplier_id: this.product.supplier_id,
        brand_id: this.product.brand_id,  
        product_name: this.product.product_name,
        product_quantity: this.product.product_quantity,
        product_price: this.product.product_price,
      };
      
      this.$store.dispatch('createProduct', data);

      this.componentKey += 1;
      this.$store.commit("setEmployeeLogin", false);
      this.$nextTick(() => {
        this.$store.commit("setEmployeeLogin", true);
      });
      setTimeout(() => {
        this.$store.commit("setComponentKey", this.componentKey);
      }, 800);
      $('#createProduct').modal('hide');
      this.$toast.success("Product added Successfuly!");
    },

    updateProduct(){

      this.editValue = true;

      this.retreiveSupplierId();
      this.retreiveBrandId();

      var data = {
        id: this.edit.id,
        category_id: this.category_id, 
        supplier_id: this.edit.supplier_id,
        brand_id: this.edit.brand_id,
        product_name: this.edit.product_name,
        product_quantity: this.edit.product_quantity,
        product_price: this.edit.product_price,
      };

      this.$store.dispatch('updateProduct', data);

      this.componentKey += 1;
      this.$store.commit("setEmployeeLogin", false);
      this.$nextTick(() => {
        this.$store.commit("setEmployeeLogin", true);
      });
      setTimeout(() => {
        this.$store.commit("setComponentKey", this.componentKey);
      }, 800);
      $('#editProduct').modal('hide');
      this.$toast.success("Product updated successfuly!");
    },

    deleteProduct() {

      this.$store.dispatch('deleteProduct', this.deleteId);

      this.componentKey += 1;
      this.$store.commit("setEmployeeLogin", false);
      this.$nextTick(() => {
        this.$store.commit("setEmployeeLogin", true);
      });
      setTimeout(() => {
        this.$store.commit("setComponentKey", this.componentKey);
      }, 800);
      $('#deleteProduct').modal('hide');
      this.$toast.error("Product removed successfuly!");
    },

    retreiveId(id) {
      this.deleteId = id;
    },

    clear(){
      this.product.product_name = "";
      this.product.product_quantity = "";
      this.product.product_price = "";
      this.product.supplier_name = "";
      this.product.brand_description = "";
    },

    editProduct(product){
      this.edit.id = product.id;
      this.edit.product_name = product.product_name;
      this.edit.product_quantity = product.product_quantity;
      this.edit.product_price = product.product_price;
      this.edit.supplier_id = product.supplier_id;
      this.edit.brand_id = product.brand_id;
      this.retreiveSupplierName();
      this.retreiveBrandName();
    },

    retreiveSupplierId(){
        let tempSuppliers = this.suppliers;
        
        if(this.editValue == false)
        {
          this.product.supplier_id = tempSuppliers.find(x => x.supplier_name === this.product.supplier_name).id;
        }
        else if(this.editValue == true)
        {
          this.edit.supplier_id = tempSuppliers.find(x => x.supplier_name === this.edit.supplier_name).id;
        }
    },

    retreiveBrandId(){
        let tempBrand = this.brands;

        if(this.editValue == false)
        {
          this.product.brand_id = tempBrand.find(x => x.brand_description === this.product.brand_description).id;
        }
        else if(this.editValue == true)
        {
          this.edit.brand_id = tempBrand.find(x => x.brand_description === this.edit.brand_description).id;
        }        
    },

    retreiveSupplierName(){
        let tempSuppliers = this.suppliers;
        this.edit.supplier_name = tempSuppliers.find(x => x.id === this.edit.supplier_id).supplier_name;
    },

    retreiveBrandName(){
        let tempBrand = this.brands;
        this.edit.brand_description = tempBrand.find(x => x.id === this.edit.brand_id).brand_description;
    },

  }
}
</script>
