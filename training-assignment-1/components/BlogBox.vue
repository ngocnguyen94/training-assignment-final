<template>
    <div class="blog-box wow fadeIn">
        <div class="post-media">
            <a :href="(`/blog/${ getSlugTitle }`)" title="">
                <img :src="article.banner_image" alt="" class="img-fluid">
                <div class="hovereffect">
                    <span></span>
                </div>
                <!-- end hover -->
            </a>
        </div>
        <!-- end media -->
        <div class="blog-meta big-meta text-center">
            <div class="post-sharing">
                <ul class="list-inline">
                    <li><a href="#" class="fb-button btn btn-primary"><i class="fa fa-facebook"></i> <span class="down-mobile">Share on Facebook</span></a></li>
                    <li><a href="#" class="tw-button btn btn-primary"><i class="fa fa-twitter"></i> <span class="down-mobile">Tweet on Twitter</span></a></li>
                    <li><a href="#" class="gp-button btn btn-primary"><i class="fa fa-google-plus"></i></a></li>
                </ul>
            </div><!-- end post-sharing -->
            <h4><a :href="(`/blog/${ getSlugTitle }`)" title="">{{ article.title }}</a></h4>
            <div v-html="article.description"></div>
            <small><a href="#" title="">Make Money</a></small>
            <small><a href="#" title="">{{ article.publish_date }}</a></small>
            <small><a href="#" title="">by Author</a></small>
            <small><a href="#" title=""><i class="fa fa-eye"></i> 2291</a></small>
        </div><!-- end meta -->
    </div><!-- end blog-box -->
</template>

<script>
    export default {
        props: ['article'],
        computed: {
            getSlugTitle: function() {
                return this.article.title.replace(/([~!@#$%^&*()_+=`{}\[\]\|\\:;'<>,.\/? ])+/g, '-').replace(/^(-)+|(-)+$/g,'').toLowerCase();
            }
        }
    }

</script>

<style scoped>

</style>
