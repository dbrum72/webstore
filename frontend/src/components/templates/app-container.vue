<template>
  <div class="container">

    <LoaderWait v-if="loader.active" :text="loader.text" />

    <router-view />

  </div>
</template>

<script>
import { mapState } from "vuex";
import LoaderWait from '@/components/commons/loader-wait.vue'

export default {

  name: 'AppContainer',

  components: { LoaderWait },

  computed: mapState(['loader'])
}
</script>

<style>
.container {
  grid-area: appContainer;
  display: flex;
  flex-flow: column nowrap;
  justify-content: center;
  align-items: center;
  padding: 20px;
}
</style>