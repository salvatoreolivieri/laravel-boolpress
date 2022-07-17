<template>

  <div class="blog">

    <div class="elenco-post">
        <div>
            <h1>Blog</h1>
            <p>{{this.searchType}}</p><br>
        </div>

        <PostItemComponent
          v-for="post in posts"
          :key="`posts${post.id}`"
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

    <CategoryTagsComponent
    :categories="this.categories"
    :tags="this.tags"

    @searchPostByCategory="searchPostByCategory"
    @searchPostByTag="searchPostByTag"

    />


  </div>

</template>

<script>
import PostItemComponent from '../partials/PostItemComponent.vue';
import CategoryTagsComponent from '../partials/CategoryTagsComponent.vue';
// import { apiUrl } from "../../data/config.js";

export default {
    name: "BlogComponent",

    data() {
        return {
            // Dati relativi alla chiama API:
            apiUrl: '/api/posts/',
            pagination:{
                current: null,
                last: null,
            },
            posts: null,
            categories: [],
            tags: [],

            searchType: ''
        };
    },

    methods: {
        apiRequest(page) {
            this.searchType = ''
            axios.get(this.apiUrl + '?page=' + page)
                .then(output => {

                // console.log("questo è il log dei post: ", output.data.posts.data);
                this.posts = output.data.posts.data;
                this.searchType = 'Tutti i post:'

                this.pagination = {
                    current: output.data.posts.current_page,
                    last: output.data.posts.last_page
                }

                //Categories:
                this.categories = output.data.categories
                console.log("questo è il log delle categorie: ", this.categories);

                //Tags:
                this.tags = output.data.tags
                console.log("questo è il log dei tags: ", this.tags);


                //console.log(this.pagination );
            })
                // Qui gestisco l'errore:
                .catch(error => {
                console.log(error);
            });
        },

        searchPostByCategory(slug_category){
            //console.log(slug_category);
            axios.get(this.apiUrl + 'post-category/' + slug_category)
                .then( output=>{
                    console.log(output.data.posts);
                    this.posts = output.data.posts

                    this.searchType = `Tutti i post con categoria: ${slug_category}`
                })
        },

        searchPostByTag(slug_tag){
            //console.log(slug_tag );
            axios.get(this.apiUrl + 'post-tag/' + slug_tag)
                .then( output=>{
                    //console.log(output.data.posts);
                    this.posts = output.data.posts

                    this.searchType = `Tutti i post con tag: ${slug_tag}`
                })

        }
    },
    mounted() {
        this.apiRequest(1);
    },
    components: { PostItemComponent, CategoryTagsComponent }
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
