export default {
  // Global page headers: https://go.nuxtjs.dev/config-head
  head: {
    title: 'Markedia - Marketing Blog Template',
    htmlAttrs: {
      lang: 'en'
    },
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      { hid: 'description', name: 'description', content: '' },
      { name: 'format-detection', content: 'telephone=no' }
    ],
    link: [
      { rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' },
      { rel: "StyleSheet", href: "/css/bootstrap.css"},
      { rel: "StyleSheet", href: "/css/font-awesome.min.css"},
      { rel: "StyleSheet", href: "/css/style.css"},
      { rel: "StyleSheet", href: "/css/animate.css"},
      { rel: "StyleSheet", href: "/css/responsive.css"},
      { rel: "StyleSheet", href: "/css/colors.css"},
      { rel: "StyleSheet", href: "/css/version/marketing.css"},
      {
        rel: "stylesheet",
        href: "https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@400;500;700&display=swap",
      },
    ],
    script: [
        {
            type: 'text/javascript',
            src: 'js/jquery.min.js',
            body: true
        },
        {
            type: 'text/javascript',
            src: 'js/tether.min.js',
            body: true
        },
        {
            type: 'text/javascript',
            src: 'js/bootstrap.min.js',
            body: true
        },
        {
            type: 'text/javascript',
            src: 'js/animate.js',
            body: true
        },
        {
            type: 'text/javascript',
            src: 'js/custom.js',
            body: true
        }
    ]
  },

  // Global CSS: https://go.nuxtjs.dev/config-css
  css: [
  ],

  // Plugins to run before rendering page: https://go.nuxtjs.dev/config-plugins
  plugins: [
  ],

  // Auto import components: https://go.nuxtjs.dev/config-components
  components: true,

  // Modules for dev and build (recommended): https://go.nuxtjs.dev/config-modules
  buildModules: [
  ],

  // Modules: https://go.nuxtjs.dev/config-modules
  modules: [
  ],

  // Build Configuration: https://go.nuxtjs.dev/config-build
  build: {
  }
}
