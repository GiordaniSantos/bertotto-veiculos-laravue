/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import { createApp } from 'vue';

import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

/* importando e configurando o vuex*/
import Vuex from 'vuex';
import router from './routes' // <---

import { library } from "@fortawesome/fontawesome-svg-core";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { fas } from '@fortawesome/free-solid-svg-icons'
library.add(fas);
import { fab } from '@fortawesome/free-brands-svg-icons';
library.add(fab);
import { far } from '@fortawesome/free-regular-svg-icons';
library.add(far);
import { dom } from "@fortawesome/fontawesome-svg-core";
dom.watch();

import { createStore } from 'vuex';

const store = createStore({ 
    state: { 
        item: {} 
    }    
})

/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp({});
const appSite = createApp({});
app.use(store)
app.use(router);
app.component("font-awesome-icon", FontAwesomeIcon);

appSite.use(store)
appSite.use(router);
appSite.component("font-awesome-icon", FontAwesomeIcon);

import ExampleComponent from './components/ExampleComponent.vue';
import Login from './components/Login.vue';
import Home from './components/Home.vue';
import Contato from './components/contato/Contato.vue';
import InputContainer from './components/InputContainer.vue';
import Table from './components/Table.vue';
import Card from './components/Card.vue';
import CreateContato from './components/contato/CreateContato.vue';
import Paginate from './components/Paginate.vue';
import ListBanner from './components/banner/ListBanner.vue';
import AddBanner from './components/banner/AddBanner.vue';
import ListMarca from './components/marca/ListMarca.vue';
import AddMarca from './components/marca/AddMarca.vue';
import EditConfiguracao from './components/configuracao/EditConfiguracao.vue';
import Veiculos from './components/veiculo/Veiculos.vue';
import AddVeiculo from './components/veiculo/AddVeiculo.vue';
import HomeSite from './components/site/HomeSite.vue';
import VeiculosSite from './components/site/VeiculosSite.vue';
import Menu from './components/site/partials/Menu.vue';
import Principal from './components/site/Principal.vue';
import FormContato from './components/site/FormContato.vue';
import ViewVeiculo from './components/site/ViewVeiculo.vue';
import ContatoSite from './components/site/ContatoSite.vue';
import Header from './components/site/partials/Header.vue';
import Footer from './components/site/partials/Footer.vue';
import NotFound from './components/NotFound.vue';
app.component('example-component', ExampleComponent);
app.component('login-component', Login);
app.component('home-component', Home);
app.component('contato-component', Contato);
app.component('input-container-component', InputContainer);
app.component('table-component', Table);
app.component('card-component', Card);
app.component('create-contato-component', CreateContato);
app.component('paginate-component', Paginate);
app.component('list-banner-component', ListBanner);
app.component('add-banner-component', AddBanner);
app.component('edit-configuracao-component', EditConfiguracao);
app.component('list-veiculo-component', Veiculos);
app.component('add-veiculo-component', AddVeiculo);
app.component('list-marca-component', ListMarca);
app.component('add-marca-component', AddMarca);
appSite.component('home-site-component', HomeSite);
appSite.component('veiculos-site-component', VeiculosSite);
appSite.component('menu-site-component', Menu);
appSite.component('principal-site-component', Principal);
appSite.component('form-site-component', FormContato);
appSite.component('paginate-component', Paginate);
appSite.component('view-veiculo-site-component', ViewVeiculo);
appSite.component('contato-site-component', ContatoSite);
appSite.component('header-site-component', Header);
appSite.component('footer-site-component', Footer);
appSite.component('not-found-component', NotFound);
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */

app.use(Vuex);

app.use(VueSweetalert2);

app.mount('#app');

appSite.use(Vuex);

appSite.use(VueSweetalert2);

appSite.mount('#app-site');