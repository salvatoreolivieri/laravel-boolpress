<template>

  <div>

    <div>
        <h1>Blog</h1>
        <p>Ecco i nostri post</p><br>
    </div>

    <div
      v-for="(item, index) in this.posts"
      :key="index">

      <h3>{{item.title}}</h3>

      <p>{{item.content}}</p><br>

    </div>

  </div>

</template>

<script>
export default {
    name: "BlogComponent",

    data() {
        return {
            // Dati relativi alla chiama API:
            apiUrl: "http://127.0.0.1:8001/api/post",
            posts: null
        };
    },

    methods: {
        apiRequest() {
            axios.get(this.apiUrl)
                .then(output => {
                console.log("questo è il log dei post: ", output.data.posts);
                this.posts = output.data.posts;
            })
                // Qui gestisco l'errore:
                .catch(error => {
                console.log(error);
            });
        },
    },

    mounted() {
        this.apiRequest();
    },
}
</script>

<style lang="scss" scoped>

</style>
