<template>
    <main :class="currentPath()">  
    <clock></clock>
    <slot></slot>
  </main>
</template>

<script>
  import VLink from './components/VLink.vue'
  import Clock from './components/Clock.vue'

  export default {
    components: {
      VLink,
      Clock
    },
    methods: {
      currentPath: function() {
        return this.$root.currentView().toLowerCase();
      }
    }
  }
</script>