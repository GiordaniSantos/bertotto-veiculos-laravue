<template>
    <div class="site-index">
        <div class="body-content">
            <!--<section v-if="banners && banners.length >= 2">
                <Carousel>
                    <Slide v-for="banner, key in banners" :key="key" style="display: block;">
                        <div class="carousel__item" v-if="banner.arquivo"><img :src="urlBaseImg+'/storage/uploads/banner/'+banner.arquivo.id+'/'+banner.arquivo.arquivo" alt="Banner" class="banner-capa" width="100%" style="width: 100%;"></div>
                    </Slide>
                    <template #addons>
                        <Navigation />
                    </template>
                </Carousel>
            </section>
            <section v-else>
                <img v-if="banners[0] && banners[0].arquivo" :src="urlBaseImg+'/storage/uploads/banner/'+banners[0].arquivo.id+'/'+banners[0].arquivo.arquivo" alt="Banner" class="banner-capa" width="100%" style="width: 100%;">
            </section>-->
            <section>
                <img :src="urlBaseImg+'/public/images/bannerbv.png'" alt="Banner" class="banner-capa" width="100%" style="width: 100%;">
            </section>
            <section v-if="veiculosDestaque" class="margin-section">
                <div class="container-fluid">
                    <div class="row" v-if="veiculosDestaque[0]">
                        <div class="col-12 col-md-12 col-lg-6" style="padding: 0;">
                            <div class="img-veiculo-capa text-center"  v-if="veiculosDestaque[0].arquivos && veiculosDestaque[0].arquivos.length != 0">
                                <img :src="urlBaseImg+'/storage/uploads/veiculo/'+veiculosDestaque[0].arquivos[0].id+'/'+veiculosDestaque[0].arquivos[0].arquivo" width="100%" :alt="veiculosDestaque[0].nome" :title="veiculosDestaque[0].nome" style="width: 100%;">
                            </div>
                            <div class="img-veiculo-capa text-center" v-else>
                                <img :src="urlBaseImg+'/images/indisponivel.jpg'" width="100%" alt="Indisponível" title="Indisponível" style="width: 100%;">
                            </div>
                        </div>
                        <div class="col-12 col-md-12 col-lg-6 margin-top-responsiva paddingResponsivo padding80">
                            <div class="row">
                                <div class="col-12">
                                    <h2 class="titulo" v-if="veiculosDestaque[0].nome">{{veiculosDestaque[0].nome}}<span class="square"></span></h2>
                                </div>
                                <div class="col-12 text-left">
                                    <p class="texto-black" v-if="veiculosDestaque[0].descricao">{{veiculosDestaque[0].descricao.slice(0, 840)}}</p>
                                    <br />
                                    <router-link :to="{name: 'ViewVeiculo', params: { id: veiculosDestaque[0].id, nome: formatarTituloParaLink(veiculosDestaque[0].nome)  }}" class="btn-padrao">Ver detalhes</router-link>
                                </div>
                            </div>   
                        </div>
                    </div>   
                </div>
                <destaque-skeleton-component :loading="loading"></destaque-skeleton-component>
            </section>
            <section v-if="veiculosDestaque.length == 2 || veiculosDestaque.length > 1" class="bg-fundo-dark margin-section column">
                <div class="container-fluid">
                    <div class="row" v-if="veiculosDestaque[1]">
                        <div class="col-12 col-md-12 col-lg-6 margin-top-responsiva paddingResponsivo padding80 d2">
                            <div class="row">
                                <div class="col-12">
                                    <h2 class="titulo titulo-white" v-if="veiculosDestaque[1].nome">{{veiculosDestaque[1].nome}}<span class="square"></span></h2>
                                </div>
                                <div class="col-12 text-right">
                                    <p class="texto-white" v-if="veiculosDestaque[1].descricao">{{veiculosDestaque[1].descricao.slice(0, 840)}}</p>
                                    <br />
                                    <router-link v-if="veiculosDestaque[1]" :to="{name: 'ViewVeiculo', params: { id: veiculosDestaque[1].id, nome: formatarTituloParaLink(veiculosDestaque[1].nome) }}" class="btn-padrao btn-cor-branco">Ver detalhes</router-link>
                                </div>
                            </div>   
                        </div>
                        <div class="col-12 col-md-12 col-lg-6 d1" style="padding: 0;">
                            <div class="img-veiculo-capa text-center" v-if="veiculosDestaque[1].arquivos && veiculosDestaque[1].arquivos.length != 0">
                                <img :src="urlBaseImg+'/storage/uploads/veiculo/'+veiculosDestaque[1].arquivos[0].id+'/'+veiculosDestaque[1].arquivos[0].arquivo" width="100%" :alt="veiculosDestaque[1].nome" :title="veiculosDestaque[1].nome" style="width: 100%;">
                            </div>
                            <div class="img-veiculo-capa text-center" v-else>
                                <img :src="urlBaseImg+'/images/indisponivel.jpg'" width="100%" alt="Indisponível" title="Indisponível" style="width: 100%;">
                            </div>
                        </div>
                    </div>
                </div>
                
            </section>
            <section v-if="veiculosDestaque.length == 3 || veiculosDestaque.length > 2" class="margin-section">
                <div class="container-fluid">
                    <div class="row" v-if="veiculosDestaque[2]">
                        <div class="col-12 col-md-12 col-lg-6" style="padding: 0;">
                            <div class="img-veiculo-capa text-center" v-if="veiculosDestaque[2].arquivos && veiculosDestaque[2].arquivos.length != 0">
                                <img :src="urlBaseImg+'/storage/uploads/veiculo/'+veiculosDestaque[2].arquivos[0].id+'/'+veiculosDestaque[2].arquivos[0].arquivo" width="100%" :alt="veiculosDestaque[2].nome" :title="veiculosDestaque[2].nome" style="width: 100%;">
                            </div>
                            <div class="img-veiculo-capa text-center" v-else>
                                <img :src="urlBaseImg+'/images/indisponivel.jpg'" width="100%" alt="Indisponível" title="Indisponível" style="width: 100%;">
                            </div>
                        </div>
                        <div class="col-12 col-md-12 col-lg-6 paddingResponsivo padding80">
                            <div class="row">
                                <div class="col-12">
                                    <h2 class="titulo" v-if="veiculosDestaque[2].nome">{{veiculosDestaque[2].nome}}<span class="square"></span></h2>
                                </div>
                                <div class="col-12 text-left">
                                    <p class="texto-black" v-if="veiculosDestaque[2].descricao">{{veiculosDestaque[2].descricao.slice(0, 840)}}</p>
                                    <br />
                                    <router-link v-if="veiculosDestaque[2]" :to="{name: 'ViewVeiculo', params: { id: veiculosDestaque[2].id, nome: formatarTituloParaLink(veiculosDestaque[2].nome) }}" class="btn-padrao">Ver detalhes</router-link>
                                </div>
                            </div>   
                        </div>
                    </div>
                </div>  
            </section>
            <section class="padding5 bg-fundo-dark " :class="border">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-12">
                            <div class="d-flex ">
                                <p class="texto-white line-height30">Siga nossas Redes Sociais</p>
                                <div style="margin-left: 30px;line-height: 26px;"> 
                                    <a href="https://www.facebook.com/bertotto.veic/" target="_blank" class="midia-footer">
                                        <img :src="urlBaseImg+'/images/facebook.png'" alt="Facebook" width="24" class="midia-topo">
                                    </a>
                                    <a href="https://www.instagram.com/bertottoveiculos/" target="blank" class="midia-footer">
                                        <img :src="urlBaseImg+'/images/instagram.png'" alt="Instagram" width="24" class="midia-topo">
                                    </a>
                                </div>  
                            </div> 
                        </div>
                    </div>
                </div>
            </section>
            <section class="padding30">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-12">
                            <div class="row">
                                <div class="col-12">
                                    <h2 class="titulo">Recomendamos para você<span class="square"></span></h2>
                                </div>
                                <div class="row" v-if="veiculosRecomendado && veiculosRecomendado.lenght != 0">
                                    <div class="col-12 col-md-6 col-lg-3 text-center padding-recomendado" v-for="veiculo, key in veiculosRecomendado" :key="key">
                                        <div class="box-veiculo-capa">
                                            <div v-if="veiculo.arquivos && veiculo.arquivos.lenght !=0">
                                                <img :src="urlBaseImg+'/storage/uploads/veiculo/'+veiculo.arquivos[0].id+'/'+veiculo.arquivos[0].arquivo" class="imagem-recomendacao" width="100%" :alt="veiculo.nome" :title="veiculo.nome" style="width: 100%;">
                                            </div>
                                            <div v-else>
                                                <img :src="urlBaseImg+'/images/indisponivel.jpg'" width="100%" alt="Indisponível" title="Indisponível" style="width: 100%;">
                                            </div>
                                            <h3 style="margin-top: 15px; margin-bottom: 15px;">{{veiculo.nome}}</h3>
                                            <div class="info">{{veiculo.ano_modelo}} - {{veiculo.km}}km</div>
                                            <div class="preco preco-titulo">R$ {{veiculo.preco}}</div>
                                            <br />
                                            <router-link :to="{name: 'ViewVeiculo', params: { id: veiculo.id, nome: formatarTituloParaLink(veiculo.nome) }}" class="btn-padrao">Ver detalhes</router-link>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" v-if="loading">
                                    <div class="col-12 col-md-6 col-lg-3 text-center padding-recomendado">
                                        <div class="box-veiculo-capa">
                                            <img src="" class="imagem-recomendacao skeleton" width="100%" style="width: 100%; background: rgb(221, 219, 221);">
                                            <h3 class="skeleton" style="margin-top: 15px; margin-bottom: 15px; background: rgb(221, 219, 221);"></h3>
                                            <div class="info skeleton" style="background: rgb(221, 219, 221);"></div>
                                            <div class="preco preco-titulo skeleton" style="background: rgb(221, 219, 221);"></div>
                                            <br />
                                            <a class="btn-padrao skeleton" style="background: rgb(221, 219, 221);"></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <br>
                                        <router-link to="/veiculos" class="btn-padrao">Ver todos</router-link>
                                    </div>
                                </div>
                            </div>   
                        </div>
                    </div>
                </div>
            </section>
            <hr>
            <section class="padding30">
                <div class="container-fluid-resp">
                    <div class="row">
                        <div class="col-12 col-md-12">
                            <div class="row">
                                <div class="row">
                                    <form-site-component></form-site-component>
                                </div>
                            </div>   
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <br><br>
    </div>
    <section class="padding10 bg-fundo-dark">
    </section>
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3460.8457791442443!2d-51.12890152351193!3d-29.83987302182192!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95196ff6686714df%3A0x2cc1eae54f3d005f!2sBertotto%20Ve%C3%ADculos!5e0!3m2!1spt-BR!2sbr!4v1683158378770!5m2!1spt-BR!2sbr" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>


</template>

<script>
import { Carousel, Navigation, Pagination, Slide } from 'vue3-carousel'

import 'vue3-carousel/dist/carousel.css'

export default{
        components: {
            Carousel,
            Slide,
            Pagination,
            Navigation,
        },
        data(){
            return {
                urlBase: '',
                urlBaseImg: '',
                loading: true,
                veiculosDestaque: {},
                veiculosRecomendado: {},
                banners: {},
            }
        },
        computed: {
            border(){
                let border = '';
                if(this.veiculosDestaque.length == 2){
                    border = 'borders-redes'
                }else{
                    border = '';
                }

                return border;
            },
        },  
        methods: {
            formatarTituloParaLink(nome) {
                return nome.normalize('NFD').replace(/[\u0300-\u036f]/g, "").toLowerCase().replace(/[- ]+/g, "-").replace(/[. ]/g, "-");
            },
            carregarListaDestaque(){

                let url = this.urlBase + '/veiculos/destaque';

                /*this.$swal({title: 'Carregando',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    onOpen: () => {
                    swal.showLoading();
                }}); */

                axios.get(url)
                    .then(response => {
                        this.veiculosDestaque  = response.data;
                       // this.$swal.close();
                    })
                    .catch(errors => {
                        this.$swal("Oops...", "Algum erro aconteceu! " +errors.response, "error");
                    });
            },
            carregarListaRecomendado(){

                let url = this.urlBase + '/veiculos/recomendado';

                axios.get(url)
                    .then(response => {
                        this.veiculosRecomendado  = response.data;
                        this.loading = false;
                    })
                    .catch(errors => {
                        this.$swal("Oops...", "Algum erro aconteceu! " +errors.response, "error");
                    });
            },
            carregarBanners(){

                let url = this.urlBase + '/banner';

                axios.get(url)
                    .then(response => {
                        this.banners  = response.data;
                    })
                    .catch(errors => {
                        this.$swal("Oops...", "Algum erro aconteceu! " +errors.response, "error");
                    });
                },
        },
        created() {
            this.urlBase = import.meta.env.VITE_API_URL_SITE;
            this.urlBaseImg = import.meta.env.VITE_URL_BASE_IMG;
            document.title = "Bertotto Veículos";
            this.carregarBanners();
            this.carregarListaDestaque();
            this.carregarListaRecomendado();
        }
    }
</script>

