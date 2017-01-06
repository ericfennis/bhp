<template>
  <a
    v-bind:href="href"
    v-bind:class="{ active: isActive }"
    v-on:click="go"
  >
    <slot></slot>
  </a>
</template>

<script>
  import routes from '../routes'
  export default {
    props: {
      href: String,
      required: true
    },
    computed: {
      isActive () {
        return this.href === this.$root.currentRoute
      }
    },
    methods: {
      go (event) {
        event.preventDefault();
        this.$root.currentRoute = this.href;
        this.$root.currentRoute == "/" ? this.$root.exitMap():'';
        window.history.pushState(
          null,
          routes[this.href],
          this.href
        )
        if(this.func !== null) {
            this.func;
        }
      }   
    }
  }
</script>

<style scoped>
  .active {
    color: cornflowerblue;
  }
</style>