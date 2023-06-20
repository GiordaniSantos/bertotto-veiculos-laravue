<template>
    <section class="margin40T">
        <div class="container-fluid-resp">
            <div class="row">
                <div class="col-12 col-xl-8 col-xxl-9 d4">
                    <div class="titulo">
                        Veículos em Estoque
                        <span></span>
                    </div>
                    <lista-veiculo-site-component ref="listaVeiculos"></lista-veiculo-site-component>
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
                        <button class="btn-busca" @click="limpar()">Limpar</button>
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
                urlPaginacao: '',
                urlFiltro: '',
                marcas: {},
                busca: { nome:'', marca_id:'', tipo_combustivel: '' }
            }
        },
        methods: {
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
                this.$refs.listaVeiculos.carregarListaVeiculos(this.urlFiltro);
            },
            limpar(){
                this.busca.nome = '';
                this.busca.marca_id = '';
                this.busca.tipo_combustivel = '';
                this.$refs.listaVeiculos.carregarListaVeiculos();
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
            document.title = "Estoque de Veículos";
            this.carregarMarcas();
        }
    }
</script>
