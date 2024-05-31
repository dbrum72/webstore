<template>
    <div class="navbar" v-show="isNavbarVisible">
        <div>
            <img src="@/assets/logo.png">
        </div>
        <div id="nav">
            <ul>
                <li><router-link :to="{ name: 'Site' }">Início</router-link></li>
            </ul>
            <ul>
                <li><router-link :to="{ name: 'Cliente' }">Cliente</router-link></li>
            </ul>
            <ul>
                <li><router-link :to="{ name: 'Fabricante' }">Fabricante</router-link></li>                   
            </ul>
            <ul>
                <li><router-link :to="{ name: 'Fornecedor'}">Fornecedor</router-link></li>                      
            </ul>
            <ul>
                <li><router-link :to="{ name: 'Produto' }">Produto</router-link></li>                    
            </ul>
            <ul>
                <router-link :to="{ name: 'Sobre' }">Sobre</router-link>
            </ul>
        </div>
    </div>
</template>

<script>
import { mapMutations, mapState } from "vuex";

export default {

    name: "AppNavbar",

    computed: mapState(['isNavbarVisible']),

    methods: {

        ...mapMutations([
            'SET_FORNECEDOR',
            'SET_TOGGLE_MENU'
        ]),

        setNovoFabricante() {
            this.SET_FABRICANTE({})
            this.$router.push('/fabricante/salvar')
        },
    }
}
</script>

<style scoped>
.navbar {
    grid-area: appNavbar;
    display: flex;
    flex-flow: column nowrap;
    justify-content: start;
    align-items: center;
    background: rgb(32, 48, 65);
    background: linear-gradient(180deg, rgba(32, 48, 65, 1) 20%, rgba(56, 227, 139, 1) 80%);
}

ul {
    list-style-type: none;
}

/* nav {
    display: flex;
    flex-flow: column nowrap;
    justify-content: start;
    align-items: center;
} */

#nav a {
    text-decoration: none;

    color: #ececec;
}

/* nav a.router-link-exact-active {
    color: #5AE2A5;
} */
</style>