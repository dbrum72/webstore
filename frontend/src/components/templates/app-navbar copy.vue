<template>
	<div class="navbar" v-show="isNavbarVisible">
        <img src="@/assets/logo.png">
		<nav>
			<router-link :to="{ name: 'Site' }">Início</router-link>
			<router-link :to="{ name: 'Cliente' }">Cliente</router-link>
			<router-link :to="{ name: 'Produto' }">Produto</router-link>
			<router-link :to="{ name: 'Sobre' }">Sobre</router-link>
		</nav>
	</div>
</template>

<script>
import { mapMutations, mapState } from "vuex";

export default {

	name: "AppNavbar",

    computed: mapState(['isNavbarVisible']),

    methods: {

      ...mapMutations(['SET_TOGGLE_MENU']),
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
    background: rgb(32,48,65);
    background: linear-gradient(180deg, rgba(32,48,65,1) 20%, rgba(56,227,139,1) 80%);
}

nav {
    display: flex;
    flex-flow:column nowrap;    
    justify-content: start;
    align-items: center;
}

nav a {
    padding: 0.5rem;
    text-decoration: none;
    font-weight: bold;
    color: #ececec;
}

nav a.router-link-exact-active {
    color: #5AE2A5;
}
</style>