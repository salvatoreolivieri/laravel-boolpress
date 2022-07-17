<template>
  <div>

    <h3>{{post.title}}</h3><br>

    <p>{{post.content}}</p><br><br>

  </div>
</template>

<script>
export default {
    name:'PostItemComponent',
    props:{
        post: Object,
    }
}
</script>

<style>

</style>
