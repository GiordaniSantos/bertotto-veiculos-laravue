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
                <div class="col-3">
                    <div class="info-item">
                        <div class="info-item-icon">
                            <i class="fa-solid fa-calendar-days"></i>
                        </div>
                        <div>
                            <div class="label">
                                Ano
                            </div>
                            <div class="value">
                                2010 / 2011
                            </div>
                        </div>
                    </div>
                </div>  
                <div class="col-3">
                    <div class="info-item">
                        <div class="info-item-icon">
                            <img :src="urlBaseImg+'/images/velocimetro-do-carro.png'" width="100%" alt="Indisponível" title="Indisponível" style="width: 100%;">
                        </div>
                        <div>
                            <div class="label">
                                Km
                            </div>
                            <div class="value">
                                117.000
                            </div>
                        </div>
                    </div>
                </div>  
                <div class="col-3">
                    <div class="info-item">
                        <div class="info-item-icon">
                            <img :src="urlBaseImg+'/images/cambio-de-marchas.png'" width="100%" alt="Indisponível" title="Indisponível" style="width: 100%;">
                        </div>
                        <div>
                            <div class="label">
                                Câmbio
                            </div>
                            <div class="value">
                                Automático
                            </div>
                        </div>
                    </div>
                </div>  
                <div class="col-3">
                    <div class="info-item">
                        <div class="info-item-icon">
                            <img :src="urlBaseImg+'/images/porta-do-carro.png'" width="100%" alt="Indisponível" title="Indisponível" style="width: 100%;">
                        </div>
                        <div>
                            <div class="label">
                                Portas
                            </div>
                            <div class="value">
                                4
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
            <br>
            <div class="row">
                <div class="col-3">
                    <div class="info-item">
                        <div class="info-item-icon">
                            <i class="fa-solid fa-fill-drip"></i>
                        </div>
                        <div>
                            <div class="label">
                                Cor
                            </div>
                            <div class="value">
                                Vermelho
                            </div>
                        </div>
                    </div>
                </div>  
                <div class="col-3">
                    <div class="info-item">
                        <div class="info-item-icon">
                            <i class="fa-solid fa-gas-pump"></i>
                        </div>
                        <div>
                            <div class="label">
                                Combustível
                            </div>
                            <div class="value">
                                Flex
                            </div>
                        </div>
                    </div>
                </div>  
                <div class="col-3">
                    <div class="info-item">
                        <div class="info-item-icon">
                            <i class="fa-solid fa-calendar"></i>
                        </div>
                        <div>
                            <div class="label">
                                Data de Publicação
                            </div>
                            <div class="value">
                                24/02/2023
                            </div>
                        </div>
                    </div>
                </div>  
                <div class="col-3">
                    <div class="info-item">
                        <div class="info-item-icon">
                            <i class="fa-solid fa-handshake"></i>
                        </div>
                        <div>
                            <div class="label">
                                Aceita Troca
                            </div>
                            <div class="value">
                                Sim
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
        </div>
    </section>
    <br>
    <Carousel :items-to-show="2.5" :wrap-around="true" v-if="veiculo.arquivos.length > 1">
        <Slide v-for="arquivo, key in veiculo.arquivos" :key="key">
        <div class="carousel__item"><img :src="urlBaseImg+'/storage/uploads/veiculo/'+arquivo.id+'/'+arquivo.arquivo" class="imagem-view" width="100%" :alt="veiculo.nome" :title="veiculo.nome" ></div>
        </Slide>

        <template #addons>
        <Navigation />
        </template>
    </Carousel>
    <div v-else>
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
                <li>IPVA Pago</li>
                <li>Licenciado</li>
                <li>Air Bag</li>
                <li>Air Bag Duplo</li>
                <li>Alarme</li>
                <li>Ar Condicionado Digital</li>
                <li>Banco de Couro</li>
                <li>Banco Regulagem Altura</li>
                <li>Chave Reserva</li>
                <li>Computador de Bordo</li>
                <li>Desembaçador Traseiro</li>
                <li>Direção Elétrica</li>
                <li>Direção Escamoteável</li>
                <li>Direção Multifuncional</li>
                <li>Faróis Auxiliares</li>
                <li>Faróis de Led</li>
                <li>Freios ABS</li>
                <li>Interface</li>
                <li>Limpador Traseiro</li>
                <li>Manual do Proprietário</li>
                <li>Porta Malas Elétrico</li>
                <li>Retrovisor Elétrico</li>
                <li>Roda de Liga Leve</li>
                <li>Sensor de Chuva</li>
                <li>Sensor de Estacionamento</li>
                <li>Som no Volante</li>
                <li>Som Original</li>
                <li>Teto Panorâmico</li>
                <li>Teto Solar</li>
                <li>Travas Elétricas</li>
                <li>Vidros Elétricos</li>
            </ul>
        </div>
        <br>
        <div class="row">
            <div class="row">
                <h2 class="titulo-opcionais">Descrição</h2>
            </div>
            <div class="col-12">
                <p class="descricao-view">PEUGEOT 308 ALLURE 2.0 AUT ANO 2014 NA LINDA COR VERMELHO LUC, VERSÃO TOP DE LINHA, POSSUI AR CONDICIONADO DIGITAL DUAL ZONE, DIREÇÃO ELETRO-HIDRÁULICA ESCAMOTEÁVEL E MULTIFUNCIONAL, TETO SOLAR PANORÂMICO COM CORTINA ELÉTRICA, PILOTO AUTOMÁTICO, COMPUTADOR DE BORDO, ACENDIMENTO DO FAROL AUTOMÁTICO E ACIONAMENTO DO LIMPADOR DE PARABRISA AUTOMÁTICO, RÁDIO ORIGINAL COM COMANDOS NO VOLANTE, BANCOS EM COURO COM REGULAGEM DE ALTURA E APOIO DE BRAÇO INDIVIDUAL, ESPELHOS ELÉTRICOS, VIDROS ELÉTRICOS, TRAVAS ELÉTRICAS, PORTA-MALAS ELÉTRICO, ALARME ORIGINAL NA CHAVE CANIVETE COM INTERFACE, SENSOR DE ESTACIONAMENTO, RODAS DE LIGA LEVE ORIGINAIS ARO 17", FREIO À DISCO NAS 4 RODAS, FAROLETES, LEDS DIURNO, PISCA NOS ESPELHOS, MANUAL DO PROPRIETÁRIO, IPVA 2023 PG, PLACAS MERCOSUL, 104 MIL KM, PLACA I RS, SEM LEILÃO, NEM SINISTRO. TRABALHAMOS COM FINANCIAMENTO VIA BANCO EM ATÉ 60X, CONSIGNADO PARA APOSENTADOS E PENSIONISTAS DO INSS EM ATÉ 84X, PARCELAMOS SUA ENTRADA OU VALOR TOTAL NO CARTÃO DE CRÉDITO EM ATÉ 21X, UTILIZE ATÉ MESMO SEU FGTS, ACEITAMOS TROCAS POR CARRO OU MOTO MEDIANTE AVALIAÇÃO. SIMULAÇÃO APENAS COM CPF E DATA DE NASCIMENTO, PODENDO SER REALIZADA ATRAVÉS DO NOSSO WHATSAPP 51 998007554. AGUARDAMOS SEU CONTATO E SUA VISITA !</p>
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
                urlBase: 'http://localhost:8000/api/v1/site',
                urlBaseImg: 'http://localhost:8000',
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
                        this.$swal.close();
                        console.log(this.veiculo.arquivos);
                    })
                    .catch(errors => {
                        this.$swal("Oops...", "Algum erro aconteceu! " +errors.response.data.message, "error");
                    });
            },
        },
        created() {
            this.carregarListaVeiculos();
        },
    }
</script>
