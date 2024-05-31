import axios from "axios";
import store from "../store"

let axiosInstance = axios.create({
  baseURL: process.env.VUE_APP_BACK_URL,
  headers: {
    'Accept': 'application/json',
    "Access-Control-Allow-Origin": "*",
    // "Access-Control-Allow-Methods": "GET,PUT,POST,DELETE,PATCH,OPTIONS"
  }
})

axiosInstance.interceptors.request.use((config) => {

  const userAuth = JSON.parse(localStorage.getItem('user_auth'))

  if(userAuth) {
  
    const {access_token, userName, userMail} = userAuth
  
    config.headers.Authorization = `Bearer ${access_token}`
    store.commit('SET_USER', {access_token , userName, userMail})
    
  }
  return config;
}, (err) => {
  store.commit('SET_USER', null)
  return Promise.reject(err)
})

axiosInstance.interceptors.response.use((response) => {
  return response
}, (error) => {
  if (error.response.status === 401) {
    // window.location = '#/login'
    this.$router.push({name: 'Login'})
  }
  return Promise.reject(error)
})

export default axiosInstance