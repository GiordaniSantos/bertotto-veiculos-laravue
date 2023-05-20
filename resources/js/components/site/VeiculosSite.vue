<template>
    <section class="margin40T">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-xl-8 col-xxl-9">
                    <div class="titulo">
                        Veículos em Estoque
                        <span></span>
                    </div>
                    <div class="row">
                        <div v-for="veiculo, key in veiculos.data" :key="key" class="col-12 col-md-3 marginB-resp">
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
                                        <router-link :to="{name: 'ViewVeiculo', params: { id: veiculo.id }}" class="btn-padrao">Ver detalhes</router-link>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <paginate-component>
                            <li v-for="link, key in veiculos.links" :key="key" :class="link.active ? 'page-item active' : 'page-item'" @click="paginacao(link)">
                                <a class="page-link" v-html="link.label"></a>
                            </li>
                        </paginate-component>
                    </div>
                    <br /><br />
                </div>
                <!--FILTRO LATERAL-->
                <div class="col-12 col-xl-4 col-xxl-3">
                    <div class="box padding-busca responsive-reverse">
                        <strong>Buscar</strong>
                        <hr />
                        <p>Abaixo você poderá realizar buscas a partir de um termo.</p>
                        
                            <div class="mb-3"> 
                            <input type="text" name="termo" placeholder="Termo..." class="form-busca" v-model="busca.nome">
  
                            </div>
                            <button type="submit" class="btn-padrao">Buscar</button>
                            <a href="/veiculos" class="btn-padrao">Limpar</a>
                        
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
                urlBase: 'http://localhost:8000/api/v1/site',
                urlBaseImg: 'http://localhost:8000',
                veiculos: {},
                urlPaginacao: '',
                urlFiltro: '',
                busca: { nome:'' }
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
                        filtro += chave + ':like:' + this.busca[chave];
                    }
                }
                if(filtro != ''){
                    this.urlPaginacao = 'page=1';
                    this.urlFiltro = '&termo=' +filtro;
                }else{
                    this.urlFiltro = '';
                }
                console.log(this.urlFiltro);
                this.carregarLista();
            },
            paginacao(links){
                if(links.url){
                    this.urlPaginacao = links.url.split('?')[1]; //ajustando a url de consulta com o parametro de pagina
                    this.carregarLista();  //requisitando novamente os dados para a API com a paginacao 
                }
            },
            carregarListaVeiculos(){

                let url = this.urlBase + '/veiculos/lista' + '?' +this.urlPaginacao + this.urlFiltro;
                
                let config = {
                    headers: {
                        'Accept': 'application/json',
                    }
                }

                this.$swal.showLoading();

                axios.get(url, config)
                    .then(response => {
                        this.veiculos  = response.data;
                        this.$swal.close();
                        console.log(this.veiculos);
                    })
                    .catch(errors => {
                        this.$swal("Oops...", "Algum erro aconteceu! " +errors.response.data.message, "error");
                    });
            },
        },
        mounted() {
            this.carregarListaVeiculos();
        },
    }
</script>
