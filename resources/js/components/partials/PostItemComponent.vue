<template>
  <div>

    <h3>
        <router-link
          :to="{name: 'detail', params:{slug: post.slug}}">

          {{post.title}}

        </router-link>
    </h3>

    <i>Ultimo aggiornamento: {{ formatDate }}</i><br><br>

    <p>{{ shortContent }}</p><br><br>

  </div>
</template>

<script>
export default {
    name:'PostItemComponent',
    props:{
        post: Object,
    },

    computed: {
        shortContent(){
            return this.post.content.substr(0,50) + ' ...';
        },

        formatDate(){
            const date = new Date(this.post.updated_at);

            let day = date.getDate();
            let month = date.getMonth();
            let year = date.getFullYear();

            if (day < 10) day = '0' + day;
            if (month < 10) month = '0' + month;

            return `${day}/${month}/${year}`
        }

    }
}
</script>

<style>

</style>
