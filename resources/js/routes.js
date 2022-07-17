

//Importiamo Vue e il Router:
import Vue from 'vue';
import VueRouter from 'vue-router';


//Dico a Vue di usare il router:
Vue.use(VueRouter)


//Importo i componenti che mi serviranno per popolare le rotte:
import HomeComponent from "./components/pages/HomeComponent";
import BlogComponent from "./components/pages/BlogComponent";
import AboutComponent from "./components/pages/AboutComponent";
import ContactsComponent from "./components/pages/ContactsComponent";
import PostDetailComponent from "./components/pages/PostDetailComponent";

//Creo il router:
const router = new VueRouter({
    mode: 'history', //questa impostazione serve per i motori di ricerca per salvarlo nella cronologia e facendo utilizzare le pagine 'avanti' e 'indietro'
    linkExactActiveClass: 'active',
    routes:[
        {
            path:'/',
            name: 'home',
            component: HomeComponent
        },

        {
            path:'/blog',
            name: 'blog',
            component: BlogComponent
        },
        {
            path:'/blog/:slug',
            name: 'detail',
            component: PostDetailComponent
        },

        {
            path:'/about',
            name: 'about',
            component: AboutComponent
        },
        {
            path:'/contacts',
            name: 'contacts',
            component: ContactsComponent
        },

    ]
})

//Lo esporto:
export default router;
