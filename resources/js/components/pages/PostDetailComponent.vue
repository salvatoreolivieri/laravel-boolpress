<template>
  <div>

    <h1>{{post.title}}</h1>
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
            })
        }
    }
}
</script>

<style lang="scss" scoped>

</style>
