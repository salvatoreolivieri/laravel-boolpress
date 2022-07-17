<template>

  <div>

    <div>
        <h1>Blog</h1>
        <p>Ecco i nostri post</p><br>
    </div>

    <PostItemComponent
      v-for="post in posts"
      :key="post.id"
      :post="post"/>

    <button
      @click="apiRequest(pagination.current - 1)"
      :disabled="pagination.current === 1">

        indietro

    </button>

    <button
      v-for="number in pagination.last"
      :key="number"
      @click="apiRequest(number)"
      :disabled="pagination.current === number">

      {{number}}

    </button>

    <button
      @click="apiRequest(pagination.current + 1)"
      :disabled="pagination.current === pagination.last">

        avanti

    </button>

  </div>

</template>

<script>
import PostItemComponent from '../partials/PostItemComponent.vue';

export default {
    name: "BlogComponent",

    data() {
        return {
            // Dati relativi alla chiama API:
            apiUrl: "http://127.0.0.1:8001/api/post",
            pagination:{
                current: null,
                last: null,
            },
            posts: null,
        };
    },

    methods: {
        apiRequest(page) {
            axios.get(this.apiUrl + '?page=' + page)
                .then(output => {

                // console.log("questo è il log dei post: ", output.data.posts.data);
                this.posts = output.data.posts.data;

                this.pagination = {
                    current: output.data.posts.current_page,
                    last: output.data.posts.last_page
                }

                //console.log(this.pagination );
            })
                // Qui gestisco l'errore:
                .catch(error => {
                console.log(error);
            });
        },
    },
    mounted() {
        this.apiRequest(1);
    },
    components: { PostItemComponent }
}
</script>

<style lang="scss" scoped>

button{

    padding: 5px 10px;
    border-radius: 10px;

    border: none;

    background-color: lightgreen;

    cursor: pointer;

    margin-right: 10px;
}

</style>
