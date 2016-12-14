<template>
    <main>  
        <!-- <nav> 
            <ul>
            <li>
                <v-link href="/">Home</v-link>
            </li>
            <li>  
                <v-link href="/list">List</v-link>
            </li>
          </ul>
        </nav>
 -->

    <slot></slot>
  </main>
</template>

<script>
  import VLink from './components/VLink.vue'


  export default {
    components: {
      VLink
    }
  }
</script>