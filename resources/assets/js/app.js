
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

var ol = require('./ol');

window.Vue = Vue;
//require('./modules/vue-click-outside');

require('./modules/vue-keyboard');

import routes from './routes'

const NotFound = { template: '<p>Page not found</p>' }


var App = window.App = new Vue({

    el: '#app',
    data: {
    	currentRoute: window.location.pathname,

    	walkPath: [],

  	},

    computed: {
	    ViewComponent () {
			const matchingView = routes[this.currentRoute]
			return matchingView
			? require('./pages/' + matchingView + '.vue')
			: require('./pages/404.vue');
		}
	  },
	created() {
    	console.log('vue loaded');
    },
    methods: {
    	getWalkpath: function(item) {
                var resource = this.$resource('api/walkpath{/id}'),
                	itemID = null;

				  // GET someItem/1
				  if(item.company_id) {
                    	//console.log(item.company_id);
                    	itemID = item.company_id;

	                } else if(item.id) {
	                    //console.log(item.id);
	                    itemID = item.id;
	                }
				  resource.get({id: itemID}).then((response) => {
				    this.walkPath = response.body;
                    //console.log(this.walkPath);
				  });                
        },
        loadMap: function() {
        	console.log("rsadASFasfun");
        },
        currentView: function() {
            return routes[this.currentRoute];
        }

    },
	render (h) { return h(this.ViewComponent) }
    
});

