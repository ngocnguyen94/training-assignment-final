<template>
    <div class="page-title db">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <h2> {{ getUppercaseName }} <small class="hidden-xs-down hidden-sm-down">Nulla felis eros, varius sit amet volutpat non. </small></h2>
                </div><!-- end col -->
                <div class="col-lg-4 col-md-4 col-sm-12 hidden-xs-down hidden-sm-down">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item">
                            <a v-if="getUppercaseName == 'Marketing'" href="#">Blog</a>
                            <a v-else href="#">Marketing</a>
                        </li>
                        <li class="breadcrumb-item active">{{ getUppercaseName }}</li>
                    </ol>
                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end container -->
    </div><!-- end page-title -->
</template>

<script>
    export default {
        props: ['directory'],
        computed: {
            getUppercaseName: function () {
                let catName = (this.directory == 'category') ? 'marketing' : this.directory;
                return (catName.charAt(0).toUpperCase() + catName.slice(1));
            }
        }
    }
</script>

<style scoped>
    .capitalize {
        text-transform: capitalize;
    }
</style>
