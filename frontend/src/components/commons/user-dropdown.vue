<template>
    <div class="user-dropdown user-button">
        <div v-if="user">
            <div>
                <span>{{ user.userName }}</span>
                <!-- <div class="user-dropdown-img">
                    <vue-gravatar :email="user.email" alt="Usuário" />
                </div> -->
                <i class="fa fa-angle-down mx-1"></i>
            </div>
            <div class="user-dropdown-content">
                <!--<router-link to="/home"><i class="fa fa-cogs"></i>Administração</router-link>-->
                <a href="" @click="logout"><i class="fa fa-sign-out me-2"></i>Sair</a>
            </div>
        </div>

        <div v-else>
            <RouterLink :to="{ name: 'Login' }">Login</RouterLink>
        </div>
    </div>
</template>

<script>
import http from "@/services/http.js";
import { mapMutations, mapState } from "vuex";

export default {

    name: "UserDropdown",

    computed: mapState(['user']),

    methods: {

        ...mapMutations(['PUSH_NOTIFICATION', 'SET_USER']),

        async logout() {

            let url = `${process.env.VUE_APP_BACKEND_URL}/logout`

            try {
                let response = await http.post(url);

                if (response.status === 200) {
                    this.PUSH_NOTIFICATION({
                        type: "sucesso",
                        message: response.data.msg,
                    });
                    localStorage.removeItem('user_auth')
                    document.cookie = "token=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;"

                    /* eslint-disable */
                    this.SET_USER(null)
                    this.$router.push({ name: "Site" })
                }
            } catch (error) {
                if (error?.response?.status) {
                    if (error?.response?.status == "404") {
                        this.PUSH_NOTIFICATION({
                            type: "informe",
                            message: "Nenhum registro foi localizado.",
                        });
                    }
                    this.errors = error.response.data.errors;
                }
            }
        },
    },
};
</script>

<style scoped>
.user-button {
    display: flex;
    align-items: center;    
    padding: 5px 10px;
    border: solid 1px rgb(32,48,65);    
    cursor: pointer
}

.user-button a {
    font-weight: 500;
    color: rgb(32,48,65);
    text-decoration: none;
}

.user-dropdown {
    position: relative;
    height: 100%;
}

.user-dropdown-content {
    display: flex;
    flex-flow: column nowrap;
    position: absolute;
    padding: 10px;
    right: 0px;
    min-width: 150px;
    background-color: #f9f9f9;
    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
    visibility: hidden;
    opacity: 0;
    transition: visibility 0s, opacity 0.5s linear;
    z-index: 1;
}

.user-dropdown-content a {
    padding: 10px;
    text-decoration: none;
    color: #000;
}

.user-dropdown-content a:hover {
    text-decoration: none;
    color: #000;
    background-color: #ededed;
}

.user-dropdown:hover {
    /* background-color: rgba(0, 0, 0, 0.2); */
}

.user-dropdown:hover .user-dropdown-content {
    visibility: visible;
    opacity: 1;
}

.user-dropdown-img {
    margin: 0px 5px;
}

.user-dropdown-img>img {
    max-height: 37px;
    border-radius: 5px;
}
</style>