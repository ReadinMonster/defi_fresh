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
          <router-link to='/admin_inventory_1'>
  					<li :class=" activeBtn == 'inventory' ? 'active' : ''">
              <span>Inventory</span>
  					</li>
          </router-link>

          <router-link to='/admin_employees'>
  					<li :class=" activeBtn == 'employee' ? 'active' : ''">  
  					  <span>Employees</span>
  					</li>
          </router-link>

          <router-link to='/admin_brands'>
  					<li :class=" activeBtn == 'brands' ? 'active' : ''">  
  					  <span>Brands</span>
  					</li>
          </router-link>

          <router-link to="/admin_suppliers">
  					<li :class=" activeBtn == 'suppliers' ? 'active' : ''">
  					  <span>Suppliers</span>
  					</li>
          </router-link>

				</ul>
			</nav>
    </div>
</template>

<script>
  export default {
    props: {
      activeBtn: String
    },
    data(){
      return{
        user_name: this.$store.state.user_name,
      }
    },
  };
</script>
