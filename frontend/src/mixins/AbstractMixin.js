import { mapMutations } from "vuex"
import http from '@/services/http.js'

export default {

    methods: {

        ...mapMutations([
            'PUSH_NOTIFICATION',
            'SET_LOADER'
        ]),

        getCookieToken() {

            const cookieToken = document.cookie
                .split("; ")
                .find((row) => row.startsWith("token="))
                ?.split("=")[1];

            return cookieToken
        },

        async getDadosApi(url) {

            this.SET_LOADER({ 'active': true, 'text': 'Carregando dados...' })

            try {
                let response = await http.get(url)
                return response.data
            }
            catch (error) {
                if (error?.response?.status == '404') {
                    this.PUSH_NOTIFICATION({
                        type: 'informe',
                        message: 'Nenhum registro foi localizado.'
                    })
                }
                this.errors = error?.response?.data.errors
            }
            finally {
                this.SET_LOADER({ 'active': false, 'text': '' })
            }
        },

        formatDate(dateString) {

            const date = new Date(dateString)
            return new Intl.DateTimeFormat('default', { dateStyle: 'short', timeStyle: 'short' }).format(date)
        }
    }
}