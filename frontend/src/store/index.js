import { createStore } from 'vuex'
import axios from 'axios'

export default createStore({

    state: {
        user: null,
        cliente: {},
        clientes: {},
        fabricante: {},
        fornecedor: {},
        isNavbarVisible: false,
        notifications: [],
        loader: {}
    },

    getters: {

        isLogged(state) {
            return state.user
        }
    },

    mutations: {

        /***** USER ********************************************************************/
        
        SET_USER: (state, user) => {
            state.user = user
            if (state.user) {
                axios.defaults.headers.common['Authorization'] = `Bearer ${user.access_token}`
                state.isNavbarVisible = true
            } else {
                delete axios.defaults.headers.common['Authorization']
                state.isNavbarVisible = false
            }
        },

        /***** CLIENTE *****************************************************************/

        SET_CLIENTES: (state, payload) => {
            state.clientes = payload
        },

        SET_CLIENTE: (state, payload) => {
            state.cliente = payload
        },

        /***** FABRICANTE ***************************************************************/

        SET_FABRICANTE: (state, payload) => {
            state.fabricante = payload
        },

        /***** FORNECEDOR ***************************************************************/

        SET_FORNECEDOR: (state, payload) => {
            state.fornecedor = payload
        },

        /***** NOTIFICATION *************************************************************/

        PUSH_NOTIFICATION: (state, notification) => {
            state.notifications.push({
                ...notification,
                id: Date.now().toString()
            })
        },

        FILTER_NOTIFICATION: (state, notificationToRemove) => {
            state.notifications = state.notifications.filter(notification => {
                return notification.id != notificationToRemove.id
            })
        },

        /***** LOADER  ******************************************************************/

        SET_LOADER: (state, payload) => {
            state.loader = payload
        },

        SET_TOGGLE_MENU: (state, isVisible) => {
            if (!state.user) {
                state.isNavbarVisible = false
                return
            }
            if (isVisible === undefined) {
                state.isNavbarVisible = !state.isNavbarVisible
            } else {
                state.isNavbarVisible = isVisible
            }
        }        
    },

    actions: {

    },

    modules: {

    }
})
