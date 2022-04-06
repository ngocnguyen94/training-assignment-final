import axios from 'axios';

const today = new Date().toLocaleDateString('en-CA');

// const uri = "https://newsapi.org/v2/everything?q=ps5&from=" + today + "&sortBy=publishedAt&language=en&apiKey=b1201dc50f924d7fa410c0994583bdd1";

const uri = "http://localhost:8000/api/article";

// state
export const state = () => ({
    articles: []
})

// getters
export const getters = {
    getArticleBySlug: (state) => (slug) => {
        console.log('find', state.articles.find(article => article.slug == slug));
        // return state.articles.find(article => (article.title.replace(/\s+/g, '-').toLowerCase()) == slug)
        return state.articles.find(article => article.slug == slug)
    },
    allArticles: state => state.articles
}

// actions
export const actions = {
    async getArticles({ commit }) {
        const result = await axios.get(uri)
        commit("setArticles", result.data.data)
        console.log(result.data)

    }
}

// mutations
export const mutations = {
    setArticles: (state, articles) => {
        articles.forEach(function(item, index) {
            articles[index].banner_image = 'http://localhost:8000/' + articles[index].banner_image;
          })
        state.articles = articles
    }
}
