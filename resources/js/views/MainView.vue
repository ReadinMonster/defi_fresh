<template>
    <div>
        <login v-if="!employee_logged_in && !admin_logged_in" />
        <admin-view v-if="admin_logged_in" :key="componentKey"/>
        <employee-view v-if="employee_logged_in" :key="componentKey"/>
    </div>
</template>

<script>

export default {
  beforeCreate: function(){
    this.$store.commit('setAdminLogin', false);
    this.$store.commit('setEmployeeLogin', false);
  },
  computed: {
    admin_logged_in() {
      return this.$store.state.admin_login_state;
    },
    employee_logged_in() {
      return this.$store.state.employee_login_state;
    },
    componentKey(){
      return this.$store.state.componentKey;
    }
  },
}
</script>