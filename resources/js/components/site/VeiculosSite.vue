<template>
    <section class="margin40T">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-xl-8 col-xxl-9 d4">
                    <div class="titulo">
                        Veículos em Estoque
                        <span></span>
                    </div>
                    <div class="row" v-if="veiculos.data">
                        <div v-for="veiculo, key in veiculos.data" :key="key" class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-4 col-xxl-3 marginB-resp">
                            <div class="padding10">
                                <div class="box-veiculo">
                                    <div class="text-center">
                                        <div v-if="veiculo.arquivos.length !=0">
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
                        </div>
                        <div style="margin-top: 30px;">
                            <paginate-component v-if="veiculos.data.length == 16">
                                <li v-for="link, key in veiculos.links" :key="key" :class="link.active ? 'page-item active' : 'page-item'" @click="paginacao(link)">
                                    <a class="page-link" v-html="link.label"></a>
                                </li>
                            </paginate-component>
                        </div>
                    </div>
                    <div v-if="veiculos.data.length == 0">
                        <br><br><br>
                        <h3 class="text-center">Nenhum resultado foi encontrado.</h3>
                    </div>
                    <br /><br />
                </div>
                <!--FILTRO LATERAL-->
                <div class="col-12 col-xl-4 col-xxl-3 d3">
                    <div class="box padding-busca margin-busca">
                        <strong>Filtros</strong>
                        <hr />
                        <div class="mb-3"> 
                            <label for="nome">Nome do Veículo</label>
                            <input type="text" id="nome" class="form-control" v-model="busca.nome" style="width: 100%;">
                        </div>
                        <div class="mb-3"> 
                            <label for="marca">Selecione a marca</label>
                            <select name="marca" id="marca" class="form-control" v-model="busca.marca_id">
                                <option :value="marca.id" v-for="marca in marcas" :key="marca.id"> {{marca.nome}} </option>
                            </select>
                        </div>
                        <div class="mb-3"> 
                            <label for="combustivel">Selecione o tipo de Combustível</label>
                            <select name="combustivel" id="combustivel" class="form-control" v-model="busca.tipo_combustivel">
                                <option value="4"> Flex </option>
                                <option value="5"> Diesel </option>
                                <option value="6"> Gasolina </option>
                                <option value="7"> GNV e Flex </option>
                                <option value="8"> GNV e Gasolina </option>
                                <option value="10"> GNV e Álcool </option>
                                <option value="9"> Álcool </option>
                                <option value="10"> GNV e Álcool </option>
                                <option value="11"> Elétrico </option>
                            </select>
                        </div>
                        <button class="btn-busca" @click="pesquisar()">Buscar</button>
                    
                        <a href="/veiculos" class="btn-busca">Limpar</a>
                    </div>
                </div>
            </div>
            <br/><br><br>
        </div>
    </section>
</template>

<script>
    export default{
        data(){
            return {
                urlBase: '',
                urlBaseImg: '',
                veiculos: {},
                urlPaginacao: '',
                urlFiltro: '',
                marcas: {},
                busca: { nome:'', marca_id:'', tipo_combustivel: '' }
            }
        },
        methods: {
            formatarTituloParaLink(nome) {
                return nome.normalize('NFD').replace(/[\u0300-\u036f]/g, "").toLowerCase().replace(/[- ]+/g, "-").replace(/[. ]/g, "-");
            },
            pesquisar(){
                let filtro = '';
                for(let chave in this.busca){
                    if(this.busca[chave]){
                        if(filtro != ''){
                            filtro += ';';
                        }
                        filtro += chave + ':like:%' + this.busca[chave]+'%';
                    }
                }
                if(filtro != ''){
                    this.urlPaginacao = 'page=1';
                    this.urlFiltro = '&termo=' +filtro;
                }else{
                    this.urlFiltro = '';
                }
                this.carregarListaVeiculos();
            },
            paginacao(links){
                if(links.url){
                    this.urlPaginacao = links.url.split('?')[1]; //ajustando a url de consulta com o parametro de pagina
                    this.carregarListaVeiculos();  //requisitando novamente os dados para a API com a paginacao 
                }
            },
            carregarListaVeiculos(){

                let url = this.urlBase + '/veiculos/lista' + '?' +this.urlPaginacao + this.urlFiltro;

                //this.$swal.showLoading();
                axios.get(url)
                    .then(response => {
                        this.veiculos  = response.data;
                        //this.$swal.close();
                    })
                    .catch(errors => {
                        this.$swal("Oops...", "Algum erro aconteceu! " +errors.response.data.message, "error");
                    });
            },
            carregarMarcas(){

                let url = this.urlBase + '/marcas/lista';


                axios.get(url)
                    .then(response => {
                        this.marcas  = response.data;
                    })
                    .catch(errors => {
                        this.$swal("Oops...", "Algum erro aconteceu! " +errors.response, "error");
                    });
            },
        },
        created() {
            this.urlBase = import.meta.env.VITE_API_URL_SITE;
            this.urlBaseImg = import.meta.env.VITE_URL_BASE_IMG;
            document.title = "Estoque de Veículos";
            this.carregarListaVeiculos();
            this.carregarMarcas();
        }
    }
</script>
