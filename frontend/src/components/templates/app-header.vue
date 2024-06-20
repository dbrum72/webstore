<template>
    <div class="header">
        <div>
            <img src="@/assets/logo.png">
            <router-link :to="{ name: 'Site' }">{{ title }}</router-link>
        </div>
        <div>
            
        </div>
        <div style="margin-right: 18px;">
            <UserDropdown />
        </div>
    </div>
</template>

<script>
import { mapState } from "vuex";
import UserDropdown from "@/components/commons/user-dropdown.vue";


export default {

    name: "AppHeader",

    props: {
        title: String,
    },

    components: { UserDropdown },

    computed: mapState(['user']),

    methods: {},
};
</script>

<style scoped>
.header {
    grid-area: appHeader;
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: linear-gradient(90deg, rgba(32, 48, 65, 1) 20%, rgba(56, 227, 139, 1) 80%);
    background: rgb(32, 48, 65);
    
}

img {
    margin: 8px 18px;
    height: 35px;
    width: 35px;
}
</style>
