<template>
    <div v-if="!!directory">
        <PageTitle
            :directory="directory"
        />

        <section v-if="directory == 'blog'" class="section lb">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                        <BlogBoxDisplay />
                        <hr class="invis">
                        <div class="row">
                            <div class="col-md-12">
                                <nav aria-label="Page navigation">
                                    <ul class="pagination justify-content-center">
                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">Next</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div><!-- end col -->
                        </div><!-- end row -->
                    </div><!-- end col -->
                    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                        <div class="div widget-no-style"><WidgetNewsletter /></div>
                        <TheSidebar />
                    </div><!-- end col -->
                </div><!-- end row -->
            </div><!-- end container -->
        </section>
        <section v-else class="section lb">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                        <div class="div widget-no-style"><WidgetNewsletter /></div>
                        <TheSidebar />
                    </div><!-- end col -->

                    <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                        <TheContact v-if="directory=='contact'" />
                        <div v-else>
                            <BlogBoxDisplay />
                            <hr class="invis">
                            <div class="row">
                                <div class="col-md-12">
                                    <nav aria-label="Page navigation">
                                        <ul class="pagination justify-content-center">
                                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                            <li class="page-item">
                                                <a class="page-link" href="#">Next</a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div><!-- end col -->
                            </div><!-- end row -->
                        </div>
                    </div><!-- end col -->
                </div><!-- end row -->
            </div><!-- end container -->
        </section>
    </div>
</template>

<script>
    export default {
        async asyncData({ params }) {
            const directory = params.directory.split('-')[1]
            return { directory }
        }
    }
</script>

<style scoped>

</style>
