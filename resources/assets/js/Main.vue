<template>

    <ul>
      <li>
        <v-link href="/">Home</v-link>
        <v-link href="/list">List</v-link>
      </li>


    <slot></slot>
  </div>
</template>

<script>
  import VLink from './components/VLink.vue'
  export default {
    components: {
      VLink
    }
  }
</script>