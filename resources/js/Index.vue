<template>
    <div id="main">
        <loading ref="loading" />
        <header id="header">
            <Navbar></Navbar>
        </header>
        <div id="content">
            <router-view></router-view>
        </div>
    </div>
</template>
<script>
    import Loading from './components/Loading'
  import Navbar from './components/Navbar.vue'
  export default {
    data() {
      return {
        //
      }
    },
    mounted () {
        this.$loading = this.$refs.loading
    },
    components: {
      Navbar,
      Loading
    }
  }
</script>