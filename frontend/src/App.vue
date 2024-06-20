<template>
	<div class="app">

		<AppHeader :title=$myApp />

		<AppNavbar />

		<AppContainer />		

		<AppFooter />

		<NotificationsList />
	</div>
</template>

<script>
import { mapState } from "vuex";
import AppHeader from '@/components/templates/app-header.vue'
import AppNavbar from '@/components/templates/app-navbar.vue'
import AppContainer from '@/components/templates/app-container.vue'
import AppFooter from '@/components/templates/app-footer.vue'
import NotificationsList from '@/components/commons/notifications-list.vue'

export default {

	name: 'WebstoreApp',

	components: {
		AppHeader,
		AppNavbar,
		AppContainer,
		NotificationsList,
		AppFooter,       
	},

	computed: mapState(['user', 'isNavbarVisible']),

}
</script>

<style>
.app {
	display: grid;
	grid-template:
		"appHeader appHeader" minmax(50px, auto)
		"appNavbar appNavbar" minmax(50px, auto)
		"appContainer appContainer" minmax(400px, auto)
		"appFooter appFooter" minmax(200px, auto)
		/ max(250px) 1fr;
	/* grid-row-gap: 10px; */
	-webkit-font-smoothing: antialiased;
	-moz-osx-font-smoothing: grayscale;
}

.app.hide-menu {
    grid-template:
		"appHeader appHeader" minmax(60px, auto)
		"appContainer appContainer" minmax(400px, auto)
		"appFooter appFooter" minmax(200px, auto)
		/ 1fr;
}
</style>
