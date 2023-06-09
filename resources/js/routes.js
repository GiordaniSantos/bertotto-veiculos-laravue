import { createWebHistory, createRouter } from "vue-router";

const Principal = () => import('./components/site/Principal.vue' /* webpackChunkName: "resource/js/components/banner/add" */)
const VeiculosSite = () => import('./components/site/veiculos/VeiculosSite.vue' /* webpackChunkName: "resource/js/components/banner/add" */)
const ViewVeiculos = () => import('./components/site/veiculos/ViewVeiculo.vue' /* webpackChunkName: "resource/js/components/banner/add" */)
const ContatoSite = () => import('./components/site/ContatoSite.vue' /* webpackChunkName: "resource/js/components/banner/add" */)
const NotFound = () => import('./components/NotFound.vue' /* webpackChunkName: "resource/js/components/banner/add" */)

export const routes = [
    {
        name: 'Home',
        path: '/',
        component: Principal
    },
    {
        name: 'Veiculos',
        path: '/veiculos',
        component: VeiculosSite
    },
    {
        name: 'ViewVeiculo',
        path: '/veiculos/:id/:nome',
        component: ViewVeiculos
    },
    {
        name: 'Contato',
        path: '/contato',
        component: ContatoSite
    },
    {
        path: '/:pathMatch(.*)*',
        component: NotFound
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes,
  });
  
  export default router;