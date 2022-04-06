<template>
    <header class="market-header header">
        <div class="container-fluid">
            <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <NuxtLink class="navbar-brand" to="/"><img src="images/version/market-logo.png" alt=""></NuxtLink>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <NuxtLink class="nav-link" to="/">Home</NuxtLink>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/marketing-category">Marketing</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/marketing-category">Make Money</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/marketing-blog">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/marketing-contact">Contact Us</a>
                        </li>
                    </ul>
                    <form class="form-inline">
                        <input class="form-control mr-sm-2" type="text" placeholder="How may I help?">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>
                </div>
            </nav>
        </div><!-- end container-fluid -->
    </header><!-- end market-header -->
</template>

<script>
    export default {

    }
</script>

<style scoped>

</style>
