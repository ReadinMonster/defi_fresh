import Login from './views/Login.vue';
import EmployeeDashboard from './components/EmployeeDashboard.vue';
import EmployeeDashboard2 from './components/EmployeeDashboard2.vue';
import AdminInventory1 from './components/AdminInventory1.vue';
import AdminInventory2 from './components/AdminInventory2.vue';
import AdminEmployees from './components/AdminEmployees.vue';
import AdminSuppliers from './components/AdminSuppliers.vue';
import AdminBrands from './components/AdminBrands.vue';

const routes = [
  {
    path: '/login',
    component: Login
  },
  {
    path: '/employee_dashboard',
    component: EmployeeDashboard
  },
  {
    path: '/employee_dashboard_2',
    component: EmployeeDashboard2
  },
  {
    path: '/admin_inventory_1',
    component: AdminInventory1
  },
  {
    path: '/admin_inventory_2',
    component: AdminInventory2
  },
  {
    path: '/admin_employees',
    component: AdminEmployees
  },
  {
    path: '/admin_suppliers',
    component: AdminSuppliers
  },
  {
    path: '/admin_brands',
    component: AdminBrands
  }
]


export default{
  mode: 'history',
  routes: routes
}