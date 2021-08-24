<template>
    <div>
      <nav class="navbar navbar-expand-lg navbar-light sticky-top">
				<div class="container-fluid">

          <h4 class="navbar-title">{{ navbarTitle }}</h4>

					<button to="/login" type="button" class="btn navbar-logout-btn" @click="logout">
						<span>Log Out</span>
					</button>

				</div>
			</nav>
    </div>
</template>

<script>
  export default {
    props: {
      'navbarTitle': String,
    },
    methods: {
      logout(){
          this.$store.commit('setAdminLogin', false);
          this.$store.commit('setEmployeeLogin', false);
          this.$router.push('/');
          this.$toast.success("Logged out successfuly!");
      }
    }
  }
</script>
