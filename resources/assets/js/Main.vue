<template>
    <main :class="currentPath()">  
  
    <slot></slot>
<<<<<<< HEAD


=======
    <!-- <section>
      <open-layers keep-alive></open-layers>
    </section> -->
>>>>>>> d6d38ae61e420ffc38bf76cfabb87e4076beda8f
  </main>
</template>

<script>
  import VLink from './components/VLink.vue'
  //import OpenLayers from './components/OpenLayers.vue'

  export default {
    components: {
      VLink
    },
    methods: {
      currentPath: function() {
        return this.$root.currentView().toLowerCase();
      }
    }
  }
</script>