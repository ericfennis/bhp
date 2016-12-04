
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the body of the page. From here, you may begin adding components to
 * the application, or feel free to tweak this setup for your needs.
 */

//Vue.component('example', require('./components/Example.vue'));

//Vue.component('app', require('./components/App.vue'));
// Vue.component('home', require('./components/Home.vue'));
// Vue.component('list', require('./components/List.vue'));
//Vue.component('navigation', require('./components/Navigation.vue'));

//import nav from './components/Navigation.vue';

import routes from './routes'

// import home from './components/Home.vue';
// import list from './components/List.vue';



const NotFound = { template: '<p>Page not found</p>' }
//const nav = { template:'<nav><ul><li>hoi</li></ul></nav>'}
// const Home = { template: '<p>home page</p>' }
// const About = { template: '<p>about page</p>' }
// const app = new Vue({
//     el: 'app',
// });
new Vue({

    el: '#app',
    data: {
    	currentRoute: window.location.pathname,
    	hans: 'hhaaheee'
  	},

    computed: {
	    ViewComponent () {
			const matchingView = routes[this.currentRoute]
			return matchingView
			? require('./pages/' + matchingView + '.vue')
			: require('./pages/404.vue')
		}
	  },
	created() {
    	console.log('vue loaded');
    },
	render (h) { return h(this.ViewComponent) }
    
});

window.addEventListener('popstate', () => {
  app.currentRoute = window.location.pathname
})