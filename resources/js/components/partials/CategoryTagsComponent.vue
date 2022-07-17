<template>
  <div>

    <div>
        <h3>Categorie</h3>
            <ul>
                <li
                v-for="item in categories"
                :key="item.id"
                @click="$emit('searchPostByCategory', item.slug)">

                {{item.name}}

                </li>
            </ul>
    </div>

    <br>

    <div>
        <h3>Tags</h3>
            <ul>
                <li
                v-for="item in tags"
                :key="item.id"
                @click="$emit('searchPostByTag', item.slug)">

                {{item.name}}

                </li>
            </ul>
    </div>

  </div>
</template>

<script>
export default {
    name:"CategoryTagsComponent",
    props:{
        categories: Array,
        tags: Array,
    },

    // methods: {
    //     filterCategory(){
    //         this.$emit('searchPostByCategory', item.slug)
    //     },

    //     filterTag(){
    //         this.$emit('searchPostByTag', item.slug)
    //     }
    // }
}
</script>

<style lang="scss" scoped>

li{
    cursor: pointer;
}

</style>
