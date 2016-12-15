<template>
    <main :class="currentPath()">  
  
    <slot></slot>
  </main>
</template>

<script>
  import VLink from './components/VLink.vue'

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