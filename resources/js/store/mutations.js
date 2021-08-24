//Navigation Mutations----------------------------------------
export const setButton = (state, name) => {
  state.activeButton = name;
}

export const setNavbar = (state, name) => {
  state.activeNavbar = name;
}

export const setComponentKey = (state, number) => {
  state.componentKey = number;
}

export const setAdminLogin = (state, bool) => {
  state.admin_login_state = bool;
}

export const setEmployeeLogin = (state, bool) => {
  state.employee_login_state = bool;
}

export const setCatgoryTitle = (state, name) => {
  state.category_title = name;
}

export const setCategoryId = (state, id) => {
  state.category_id = id;
}



// Retreive User Info----------------------------------------
export const setUserName = (state, array) =>{
  state.user_name = array
}

export const setUserEmail = (state, array) =>{
  state.user_email = array
}

export const setUserPassword = (state, array) =>{
  state.user_password = array
}



// Retreive Arrays----------------------------------------
export const setBrands = (state, array) =>{
  state.brands = array
}

export const setSuppliers = (state, array) =>{
  state.suppliers = array
}

export const setUsers = (state, array) =>{
  state.users = array
}

export const setCategories = (state, array) =>{
  state.categories = array
}

export const setProducts = (state, array) =>{
  state.products = array
}




// Brands Mutations----------------------------------------
export const createBrands = (state, data) =>{
  state.brands.unshift({ ...data })
}

export const updateBrand = (state, updateBrands) =>{
  let i = state.brand.findIndex((brand) => brand.id === updateBrands.id);
  state.brand.splice(i, 1, updateBrands);
}

// suppliers Mutations----------------------------------------

export const createSupplier = (state, data) =>{
  state.suppliers.unshift({ ...data })
}

export const updateSupplier = (state, updateSuppliers) =>{
  let i = state.supplier.findIndex((supplier) => supplier.id === updateSuppliers.id);
  state.supplier.splice(i, 1, updateSuppliers);
}

// users Mutations----------------------------------------

export const createUser = (state, data) =>{
  state.users.unshift({ ...data })
}

export const updateUser = (state, updateUsers) =>{
  let i = state.user.findIndex((user) => user.id === updateUsers.id);
  state.user.splice(i, 1, updateUsers);
}

export const deleteUser = (state, id) =>{
  state.users = state.users.filter((user) => user.id !== id)
}

// category Mutations----------------------------------------
export const createCategory = (state, data) =>{
  state.categories.unshift({ ...data })
}

// product Mutations----------------------------------------
export const createProduct = (state, data) =>{
  state.products.unshift({ ...data })
}

export const updateProduct = (state, updateProducts) =>{
  let i = state.product.findIndex((product) => product.id === updateProducts.id);
  state.product.splice(i, 1, updateProducts);
}

export const deleteProduct = (state, id) =>{
  state.products = state.products.filter((product) => product.id !== id)
}


