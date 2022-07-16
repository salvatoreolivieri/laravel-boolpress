

//Importiamo Vue e il Router:
import Vue from 'vue';
import VueRouter from 'vue-router';

//Dico a Vue di usare il router:
Vue.use(VueRouter)

//Creo il router:
const router = new VueRouter({
    mode: 'history' //questa impostazione serve per i motori di ricerca per salvarlo nella cronologia e facendo utilizzare le pagine 'avanti' e 'indietro'
})

//Lo esporto:
export default router;
