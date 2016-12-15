<template>
    <main :class="currentPath()">  
  
    <slot></slot>
    <!-- <section>
      <open-layers keep-alive></open-layers>
    </section> -->
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