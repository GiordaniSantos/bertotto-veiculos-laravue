import { createWebHistory, createRouter } from "vue-router";

const BannerCreate = () => import('./components/banner/AddBanner.vue' /* webpackChunkName: "resource/js/components/banner/add" */)

export const routes = [
    {
        name: 'bannerAdd',
        path: '/banner/add',
        component: BannerCreate
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes,
  });
  
  export default router;