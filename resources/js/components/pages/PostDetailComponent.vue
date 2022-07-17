<template>
  <div>

    <h1>{{post.title}}</h1>
    <span>Categoria: {{post.category}}</span><br>

    <div
      v-if="post.tags.length > 0">

        <span>Tags: </span>

        <span
          v-for="tag in post.tags"
          :key="tag.id">

            {{tag.name}}

        </span><br><br>

    </div>


    <p>{{post.content}}</p>

  </div>
</template>

<script>
import Axios from 'axios'

export default {
    name:'PostDetail',

    data() {
        return{
            apiUrl: "/api/posts/",
            post: {
                title:'',
                content: '',
                category: '',
                tags: [],
            },

        }
    },

    mounted() {
        this.apiRequest()
    },

    methods: {
        apiRequest(){
            Axios.get(this.apiUrl + this.$route.params.slug)
            .then(output =>{
                console.log(output.data);
                this.post.title = output.data.title
                this.post.content = output.data.content
                this.post.category = output.data.category.name
                this.post.tags = output.data.tags
            })
        }
    }
}
</script>

<style lang="scss" scoped>

</style>
