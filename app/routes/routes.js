import CreateNews from '../views/CreateNews.vue'
import News from '../views/News.vue'

const routes = [
    { path: '/', component: News, name: 'news'},
    { path: '/create', component: CreateNews, name: 'create'}
];


export default routes;
