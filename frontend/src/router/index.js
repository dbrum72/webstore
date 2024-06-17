import { createRouter, createWebHashHistory } from 'vue-router'

import store from '@/store'

const routes = [
    {
        path: '/',
        name: 'Site',
        component: () => import(/* webpackChunkName: "home" */ '@/views/SiteView.vue')
    },
    {
        path: '/login',
        name: 'Login',
        component: () => import('@/views/LoginView.vue')
    },
    {
        path: '/logout',
        name: 'Logout',
        component: () => import('@/views/SiteView.vue')
    },
    {
        path: '/dashboard',
        name: 'Dashboard',
        component: () => import(/* webpackChunkName: "dashboard" */ '@/views/DashboardView.vue')
    },
    {
        path: '/cliente',
        name: 'Cliente',
        component: () => import('@/views/ClienteView.vue'),
        beforeEnter: (to) => {
            if (to.name !== 'Login' && !store.getters['isLogged']) return { name: 'Login' }
        }
    },
    {
        path: '/pedido',
        name: 'Pedido',
        component: () => import('@/views/PedidoView.vue'),
        beforeEnter: (to) => {
            if (to.name !== 'Login' && !store.getters['isLogged']) return { name: 'Login' }
        }
    },    
    {
        path: '/produto',
        name: 'Produto',
        component: () => import('@/views/ProdutoView.vue'),
        beforeEnter: (to) => {
            if (to.name !== 'Login' && !store.getters['isLogged']) return { name: 'Login' }
        }
    },
    {
        path: '/sobre',
        name: 'Sobre',
        component: () => import(/* webpackChunkName: "sobre" */ '@/views/SobreView.vue')
    },
    {
        path: '/:catchAll(.*)*', redirect: { name: 'Site' }
    }
]

const router = createRouter({
    history: createWebHashHistory(process.env.BASE_URL),
    routes
})

router.beforeEach((to) => {
    document.title = process.env.VUE_APP_TITLE.toUpperCase() + ' - ' + to.name
})

export default router
