<template>
    <div class="page-wrapper">
        <div class="blog-custom-build">
            <BlogBox
                v-for="article in articles"
                :key="article.id"
                :article="article"
            />
            <hr class="invis">
        </div>
    </div>
</template>
<script>
    import { mapState, mapActions } from 'vuex';
    export default {
        computed: mapState(['articles']),
        methods:  {
            ...mapActions(['getArticles'])
        },
        created() {
            this.getArticles()
        }
    }
</script>

<style scoped>

</style>
