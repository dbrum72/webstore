<template>
    <div :class="typeClass" role="alert">
    {{ notification.message }}
    </div>
</template>

<script>
import { mapMutations } from "vuex";

export default {

    name: 'NotificationMessage',

    props: ['notification'],

    data() {
        return {
            timeout: null
        }
    },

    methods: {

        ...mapMutations(['FILTER_NOTIFICATION']),
    },

    computed: {
        typeClass() {
            return `alerta-${this.notification.type}`
        }
    },

    created() {
        this.timeout = setTimeout(() => {
            this.FILTER_NOTIFICATION(this.notification)
        }, 4000)
    },

    beforeUnmount() {
        clearTimeout(this.timeout)
    }

}  
</script>

