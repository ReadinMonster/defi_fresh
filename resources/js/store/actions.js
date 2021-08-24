import axios from "../axiosConfig.js";


// FETCHING ------------------------------------------------------------------------------------
export const fetchBrands = ({commit}) => {
  axios.get('/brands')
      .then(response =>{
          commit('setBrands', response.data);
      })
}

export const fetchSuppliers = ({commit}) => {
  axios.get('/suppliers')
      .then(response =>{
          commit('setSuppliers', response.data);
      })
}

export const fetchUsers = ({commit}) => {
  axios.get('/users')
      .then(response =>{
          commit('setUsers', response.data);
      })
}

export const fetchCategories = ({commit}) => {
  axios.get('/categories')
      .then(response =>{
          commit('setCategories', response.data);
      })
}

export const fetchProducts = ({commit}) => {
  axios.get('/products')
      .then(response =>{
          commit('setProducts', response.data);
      })
}

// BRANDS------------------------------------------------------------------------------------

export const createBrands = ({ commit }, data) => {
  axios.post('/brand', data)
      .then(response =>{
        commit('createBrands', response.data);
      })
}

export const updateBrands = ({ commit }, brand) => {
  axios.put(`/brand/${brand.id}`, brand)
    .then(response =>{
        commit('updateBrand', response.data);
        return response;
    })
}

// SUPPLIERS------------------------------------------------------------------------------------

export const createSupplier = ({ commit }, data) => {
  axios.post('/supplier', data)
      .then(response =>{
        commit('createSupplier', response.data);
      })
}

export const updateSupplier = ({ commit }, supplier) => {
  axios.put(`/supplier/${supplier.id}`, supplier)
    .then(response =>{
        commit('updateSupplier', response.data);
        return response;
    })
}

// USERS------------------------------------------------------------------------------------

export const createUser = ({ commit }, data) => {
  axios.post('/user', data)
      .then(response =>{
        commit('createUser', response.data);
      })
}

export const updateUser = ({ commit }, user) => {
  axios.put(`/user/${user.id}`, user)
    .then(response =>{
        commit('updateUser', response.data);
        return response;
    })
}

export const deleteUser = ({ commit }, id) => {
  axios.delete(`/user/${id}`)
    .then(
      commit("deleteUser", id)
    )
}

// CATEGORIES------------------------------------------------------------------------------------

export const createCategories = ({ commit }, data) => {
  axios.post('/category', data)
      .then(response =>{
        commit('createCategory', response.data);
      })
}

// Product------------------------------------------------------------------------------------

export const createProduct = ({ commit }, data) => {
  axios.post('/product', data)
      .then(response =>{
        commit('createProduct', response.data);
      })
}

export const updateProduct = ({ commit }, product) => {
  axios.put(`/product/${product.id}`, product)
    .then(response =>{
        commit('updateProduct', response.data);
        return response;
    })
}

export const deleteProduct = ({ commit }, id) => {
  axios.delete(`/product/${id}`)
    .then(
      commit("deleteProduct", id)
    )
}

