
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./vue-keyboard');


import routes from './routes'

const NotFound = { template: '<p>Page not found</p>' }

new Vue({

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
			: require('./pages/404.vue')
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
    },
	render (h) { return h(this.ViewComponent) }
    
});

var lastelement = 0;
var letter = 0;

$(document).ready(function() {
$('#keyboard_element button').click(function (event) {
	console.log('knop');	
	//ahaa!!! een knopje van het toetsenbord! even bedenken welke letter ook alweer.
	letter = $(this).attr('id');
    
	switch(letter) {
		case "wis":
			//het element dat zijn focus is verloren moet leeg.
			lastelement.get(0).value = '';
			break;

		case "bs":
			//het element dat zijn focus is verloren moet een letter af
			lastelement.get(0).value = lastelement.get(0).value.slice(0,-1);
			break;

		default:
			//het element dat zijn focus is verloren moet er een letter bij.
			setTimeout(function () { lastelement.get(0).value+=letter; }, 10);
	} 
});
});

$('input').focus(function (event) {
	//welk focussen we nu op?
	lastelement = $(this);
	lastelement.blur();
	console.log('focus');
	$('#keyboard_dialog').dialog({
        	resizable: false,
		title: 'Toetsenbord',
        	width:'auto'
	});
});