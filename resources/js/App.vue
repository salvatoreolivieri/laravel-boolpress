<template>
  <div>

    <div>
        <h1>Ecco tutti i post</h1>
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
// import App from './App.vue';
export default {
    name: 'App',
    data(){
        return{
            // Dati relativi alla chiama API:
            apiUrl: 'http://127.0.0.1:8000/api/post',
            posts: null
        }

    },

    methods:{
        apiRequest(){
            axios.get(this.apiUrl)
            .then(output =>{
                console.log('questo è il log dei post: ', output.data.posts);
                this.posts = output.data.posts;
            })

            // Qui gestisco l'errore:
            .catch(error =>{
                console.log(error);
            })
        },
    },

    mounted(){
        this.apiRequest()
    }
}
</script>

<style lang="scss" scoped>

</style>
