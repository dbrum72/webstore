<template>
    <div class="header">
        <a class="toggle" :class="{ 'toogle-hide' : !isNavbarVisible }" @click="toggleMenu" v-if="!hideToggle">
            <i class="fa-solid fa-bars fa-xl"></i>
        </a>
        <div>
            <router-link :to="{ name: 'Site' }">{{ title }}</router-link>
        </div>
        <div style="margin-right: 18px;">
            <UserDropdown />
        </div>
    </div>
</template>

<script>
import { mapState, mapMutations } from "vuex";
import UserDropdown from "@/components/commons/user-dropdown.vue";


export default {

    name: "AppHeader",

    props: {
        title: String,
        hideToggle: Boolean,
    },

    components: { UserDropdown },

    computed: mapState(['user', 'isNavbarVisible']),

    methods: {
        ...mapMutations(["SET_TOGGLE_MENU"]),

        toggleMenu() {
            this.SET_TOGGLE_MENU();
        },
    },
};
</script>

<style scoped>
.header {
    grid-area: appHeader;
    display: flex;
    justify-content:space-between;
    align-items: center;
    background: rgb(32,48,65);
    background: linear-gradient(90deg, rgba(32,48,65,1) 20%, rgba(56,227,139,1) 80%);
}

.toggle {
    color: #38e38b;
}

.toggle:hover {
    cursor: pointer;
}

.toogle-hide {
    margin-left: 1rem;
}
</style>
