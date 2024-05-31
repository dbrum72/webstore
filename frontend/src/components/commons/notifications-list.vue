<template>
  <div class="notifications-list">
    <NotificationMessage v-for="notification in notifications" :key="notification.id" :notification="notification"/>
  </div>  
</template>
      
<script>
import { mapState } from "vuex";
import NotificationMessage from "@/components/commons/notification-message.vue"

export default {

  name: "NotificationsList",

  components: {    
    NotificationMessage
  },

  computed: mapState(['notifications'])  
}
</script>

<style>
.notifications-list {
    position: fixed;
    bottom: 10px;
    right: 10px;
    margin-right: 20px;
    width: 320px;
    z-index: 10000000 !important;
}
</style>