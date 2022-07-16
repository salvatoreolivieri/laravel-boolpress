<template>

  <div>

    <HeaderComponent />

    <router-view></router-view>

    <FooterComponent />

  </div>

</template>

<script>

import FooterComponent from './components/partials/FooterComponent.vue';
import HeaderComponent from './components/partials/HeaderComponent.vue';

export default {
    name: "App",
    components: { FooterComponent, HeaderComponent },

}
</script>

<style lang="scss" scoped>

</style>
