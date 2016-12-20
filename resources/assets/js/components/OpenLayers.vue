<template>
   <figure id="map" class="map"></figure>

</template>

<script>
	var ol = require('../ol');

    export default {
        mounted() {
            this.createMap();
        },

        created() {
        	console.log(this.$root.walkpath);
        	console.log("wakkalasnfdkljasb");
        },
        methods: {

	            
