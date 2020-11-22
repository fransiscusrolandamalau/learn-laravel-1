<template>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <router-link :to="{name: 'home'}" class="navbar-brand">
                <img :src="'images/laravel-id.png'" width="35" height="35" alt="" loading="lazy">
            </router-link>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto" v-if="$auth.check(1)">
                    <li class="nav-item" v-for="(route, key) in routes.user" v-bind:key="route.path">
                        <router-link :to="{ name : route.path }" :key="key" class="nav-link">{{route.name}}</router-link>
                    </li>
                </ul>
                <ul class="navbar-nav mr-auto" v-if="$auth.check(2)">
                    <li class="nav-item" v-for="(route, key) in routes.user" v-bind:key="route.path">
                        <router-link :to="{ name : route.path }" :key="key" class="nav-link">{{route.name}}</router-link>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto" v-if="!$auth.check()">
                    <li class="nav-item" v-for="(route, key) in routes.unlogged" v-bind:key="route.path">
                        <router-link :to="{ name : route.path }" :key="key" class="nav-link">{{route.name}}</router-link>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto" v-if="$auth.check()">
                    <li class="nav-item">
                        <a class="nav-link" href="#" @click.prevent="$auth.logout()">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>
<script>
  export default {
    data() {
      return {
        routes: {
          // UNLOGGED
          unlogged: [
            { name: 'Register', path: 'register' },
            { name: 'Login', path: 'login'}
          ],
          // LOGGED USER
          user: [
            { name: 'Dashboard', path: 'dashboard' }
          ],
          // LOGGED ADMIN
          admin: [
            { name: 'Dashboard', path: 'admin.dashboard' }
          ]
        }
      }
    },
    mounted() {
      //
    }
  }
</script>

<style>
.navbar {
  margin-bottom: 30px;
}
</style>