<template>
    <section class="margin40T">
        <div class="container">
            <div class="row">
                <div id="conteudo_view" class="col">
                    <h1 class="titulo-view-veiculo"><strong>{{veiculo.nome}}</strong></h1>
                    <h3 class="preco-view-veiculo">R$ {{ veiculo.preco }}</h3><hr>
                </div>
            </div>
            <div class="row">
                <div class="col-3" v-if="veiculo.ano_modelo">
                    <div class="info-item">
                        <div class="info-item-icon">
                            <i class="fa-solid fa-calendar-days"></i>
                        </div>
                        <div>
                            <div class="label">
                                Ano
                            </div>
                            <div class="value">
                                {{ veiculo.ano_modelo }}
                            </div>
                        </div>
                    </div>
                </div>  
                <div class="col-3" v-if="veiculo.km">
                    <div class="info-item">
                        <div class="info-item-icon">
                            <img :src="urlBaseImg+'/images/velocimetro-do-carro.png'" width="100%" alt="Indisponível" title="Indisponível" style="width: 100%;">
                        </div>
                        <div>
                            <div class="label">
                                Km
                            </div>
                            <div class="value">
                                {{ veiculo.km }}
                            </div>
                        </div>
                    </div>
                </div>  
                <div class="col-3" v-if="veiculo.cambio">
                    <div class="info-item">
                        <div class="info-item-icon">
                            <img :src="urlBaseImg+'/images/cambio-de-marchas.png'" width="100%" alt="Indisponível" title="Indisponível" style="width: 100%;">
                        </div>
                        <div>
                            <div class="label">
                                Câmbio
                            </div>
                            <div class="value">
                                {{getCambioFormatado(veiculo.cambio)}}
                            </div>
                        </div>
                    </div>
                </div>  
                <div class="col-3" v-if="veiculo.portas">
                    <div class="info-item">
                        <div class="info-item-icon">
                            <img :src="urlBaseImg+'/images/porta-do-carro.png'" width="100%" alt="Indisponível" title="Indisponível" style="width: 100%;">
                        </div>
                        <div>
                            <div class="label">
                                Portas
                            </div>
                            <div class="value">
                                {{ veiculo.portas }}
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
            <br>
            <div class="row">
                <div class="col-3" v-if="veiculo.cor">
                    <div class="info-item">
                        <div class="info-item-icon">
                            <i class="fa-solid fa-fill-drip"></i>
                        </div>
                        <div>
                            <div class="label">
                                Cor
                            </div>
                            <div class="value">
                                {{ veiculo.cor }}
                            </div>
                        </div>
                    </div>
                </div>  
                <div class="col-3" v-if="veiculo.tipo_combustivel">
                    <div class="info-item">
                        <div class="info-item-icon">
                            <i class="fa-solid fa-gas-pump"></i>
                        </div>
                        <div>
                            <div class="label">
                                Combustível
                            </div>
                            <div class="value">
                                {{ getTipoCombustivelFormatado(veiculo.tipo_combustivel) }}
                            </div>
                        </div>
                    </div>
                </div>  
                <div class="col-3" v-if="veiculo.data_publicacao">
                    <div class="info-item">
                        <div class="info-item-icon">
                            <i class="fa-solid fa-calendar"></i>
                        </div>
                        <div>
                            <div class="label">
                                Data de Publicação
                            </div>
                            <div class="value">
                                {{ formataData(veiculo.data_publicacao) }}
                            </div>
                        </div>
                    </div>
                </div>  
                <div class="col-3" v-if="veiculo.aceita_troca">
                    <div class="info-item">
                        <div class="info-item-icon">
                            <i class="fa-solid fa-handshake"></i>
                        </div>
                        <div>
                            <div class="label">
                                Aceita Troca
                            </div>
                            <div class="value">
                                {{ veiculo.aceita_troca == 1 ? "Sim" : "Não" }}
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
        </div>
    </section>
    <br>
    <Carousel :items-to-show="2.5" :wrap-around="true" v-if="veiculo.arquivos && veiculo.arquivos.length > 1">
        <Slide v-for="arquivo, key in veiculo.arquivos" :key="key">
        <div class="carousel__item"><img :src="urlBaseImg+'/storage/uploads/veiculo/'+arquivo.id+'/'+arquivo.arquivo" class="imagem-view" width="100%" :alt="veiculo.nome" :title="veiculo.nome" ></div>
        </Slide>

        <template #addons>
        <Navigation />
        </template>
    </Carousel>
    <div v-else-if="veiculo.arquivos.lenght == 1">
        <div class="container">
            <img :src="urlBaseImg+'/storage/uploads/veiculo/'+veiculo.arquivos[0].id+'/'+veiculo.arquivos[0].arquivo" class="imagem-view" width="100%" :alt="veiculo.nome" :title="veiculo.nome" >
        </div>
    </div>
    <br><br>
    <div class="container">
        <div class="row">
            <h2 class="titulo-opcionais">Opcionais</h2>
        </div>
        <div>
            <ul class="list-opcionais">
                <li v-if="veiculo.ipva_pago == 1">IPVA Pago</li>
                <li v-if="veiculo.licenciado == 1">Licenciado</li>
                <li v-if="veiculo.air_bag == 1">Air Bag</li>
                <li v-if="veiculo.air_bag_duplo == 1">Air Bag Duplo</li>
                <li v-if="veiculo.alarme == 1">Alarme</li>
                <li v-if="veiculo.ar_condicionado_digital == 1">Ar Condicionado Digital</li>
                <li v-if="veiculo.banco_couro == 1">Banco de Couro</li>
                <li v-if="veiculo.banco_regulavel_altura">Banco Regulagem Altura</li>
                <li v-if="veiculo.chave_reserva">Chave Reserva</li>
                <li v-if="veiculo.computador_bordo">Computador de Bordo</li>
                <li v-if="veiculo.desembacador_traseiro">Desembaçador Traseiro</li>
                <li v-if="veiculo.direcao_eletrica">Direção Elétrica</li>
                <li v-if="veiculo.direcao_escamoteavel">Direção Escamoteável</li>
                <li v-if="veiculo.direcao_multifuncional">Direção Multifuncional</li>
                <li v-if="veiculo.farois_auxiliares">Faróis Auxiliares</li>
                <li v-if="veiculo.farois_led">Faróis de Led</li>
                <li v-if="veiculo.freios_abs">Freios ABS</li>
                <li v-if="veiculo.interface">Interface</li>
                <li v-if="veiculo.limpador_traseiro">Limpador Traseiro</li>
                <li v-if="veiculo.manual_proprietario">Manual do Proprietário</li>
                <li v-if="veiculo.porta_malas_eletrico">Porta Malas Elétrico</li>
                <li v-if="veiculo.retrovisor_eletrico">Retrovisor Elétrico</li>
                <li v-if="veiculo.liga_leve">Roda de Liga Leve</li>
                <li v-if="veiculo.sensor_chuva">Sensor de Chuva</li>
                <li v-if="veiculo.sensor_estacionamento">Sensor de Estacionamento</li>
                <li v-if="veiculo.som_volante">Som no Volante</li>
                <li v-if="veiculo.som_original">Som Original</li>
                <li v-if="veiculo.teto_panoramico">Teto Panorâmico</li>
                <li v-if="veiculo.teto_solar">Teto Solar</li>
                <li v-if="veiculo.travas_eletricas">Travas Elétricas</li>
                <li v-if="veiculo.vidros_eletricos">Vidros Elétricos</li>
            </ul>
        </div>
        <br>
        <div class="row" v-if="veiculo.descricao">
            <div class="row">
                <h2 class="titulo-opcionais">Descrição</h2>
            </div>
            <div class="col-12">
                <p class="descricao-view">{{ veiculo.descricao }}</p>
            </div>
        </div>
        <br><br>
        <div class="row nomargin">
            <div class="col-12 box-voltar">
                <a href="javascript:history.go(-1)" title="Voltar" class="btn-padrao">voltar</a>
            </div>
        </div>
        <br><br>
    </div>
</template>

<script>
import { Carousel, Navigation, Slide } from 'vue3-carousel'

import 'vue3-carousel/dist/carousel.css'

export default{
        name: 'WrapAround',
        components: {
            Carousel,
            Slide,
            Navigation,
        },
        data(){
            return {
                urlBase: '',
                urlBaseImg: '',
                veiculo: {},
                currentSlide: 0,
            }
        },
        
        methods: {
            slideTo(val) {
                this.currentSlide = val
            },
            carregarListaVeiculos(){

                let url = this.urlBase + '/veiculo/' + this.$route.params.id;

                this.$swal.showLoading();

                axios.get(url)
                    .then(response => {
                        this.veiculo  = response.data;
                        document.title = this.veiculo.nome + "- Bertotto Veículos";
                        this.$swal.close();
                    })
                    .catch(errors => {
                        this.$swal("Oops...", "Algum erro aconteceu! " +errors.response.data.message, "error");
                    });

            
            },
            formataData(d){
                if(!d) return ''

                d = d.split('T');

                let data = d[0];

                data = data.split('-');

                //formatando a data
                data = data[2] + "/" + data[1] + "/" + data[0];

                return data;
            },
            getCambioFormatado(cambio){
                let cambioFormatado = '';
                if(cambio == 1){
                    cambioFormatado = 'Câmbio Manual';
                }else if(cambio == 2){
                    cambioFormatado = 'Câmbio Automático';
                }else if(cambio == 3) {
                    cambioFormatado = 'Câmbio Automático CVT';
                } else {
                    cambioFormatado = '';
                }
                return cambioFormatado;
            },
            getTipoCombustivelFormatado(combustivel){
                let combustivelFormatado = '';
                if(combustivel == 4){
                    combustivelFormatado = 'Flex';
                }else if(combustivel == 5){
                    combustivelFormatado = 'Diesel';
                }else if(combustivel == 6) {
                    combustivelFormatado = 'Gasolina';
                } else if(combustivel == 7) {
                    combustivelFormatado = 'GNV e Flex';
                } else if(combustivel == 8) {
                    combustivelFormatado = 'GNV e Gasolina';
                } else if(combustivel == 9) {
                    combustivelFormatado = 'Alcool';
                } else if(combustivel == 10) {
                    combustivelFormatado = 'GNV e Alcool';
                } else if(combustivel == 11) {
                    combustivelFormatado = 'Elétrico';
                } else {
                    combustivelFormatado = '';
                }
                return combustivelFormatado;
            },
        },
        mounted() {
            this.urlBase = import.meta.env.VITE_API_URL_SITE;
            this.urlBaseImg = import.meta.env.VITE_URL_BASE_IMG;
            this.carregarListaVeiculos();
            console.log(this.veiculo)

        },
        created() {

        },
    }
</script>
