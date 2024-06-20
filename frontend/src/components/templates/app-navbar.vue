<template>
    <div class="navbar">
        <router-link :to="{ name: 'Site' }">Início</router-link>
        <router-link :to="{ name: 'Cliente' }">Cliente</router-link>
        <router-link :to="{ name: 'Produto' }">Produto</router-link>
        <router-link :to="{ name: 'Sobre' }">Sobre</router-link>
    </div>
</template>

<script>
export default {

    name: "AppNavbar",

    methods: {}
}
</script>

<style scoped>
.navbar {
    grid-area: appNavbar;
    display: flex;
    justify-content: center;
    align-items: center;
    background: linear-gradient(180deg, rgba(32, 48, 65, 1) 20%, rgb(56, 227, 139) 80%);
    background: rgb(47, 70, 95);
    
}

a {
    padding: 0.5rem;
    text-decoration: none;
    font-weight: bold;
    color: #ececec;
}

a:hover {
    color: #5AE2A5;
}

a.router-link-exact-active {
    color: #5AE2A5;
}
</style>