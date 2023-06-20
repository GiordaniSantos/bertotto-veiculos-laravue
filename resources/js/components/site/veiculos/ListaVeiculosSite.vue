<template>
    <div class="row" v-if="veiculos.data">
        <div v-for="veiculo, key in veiculos.data" :key="key" class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-4 col-xxl-3 marginB-resp">
            <div class="padding10">
                <div class="box-veiculo">
                    <div class="text-center">
                        <div v-if="veiculo.arquivos && veiculo.arquivos.length !=0">
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
            <paginate-component v-if="veiculos.data.length >= 20 || urlPaginacao != ''">
                <li v-for="link, key in veiculos.links" :key="key" :class="link.active ? 'page-item active' : 'page-item'" @click="paginacao(link)">
                    <a class="page-link" v-html="link.label"></a>
                </li>
            </paginate-component>
        </div>
    </div>
    <div v-if="veiculos.data && veiculos.data.length == 0">
        <br><br><br>
        <h3 class="text-center">Nenhum resultado foi encontrado.</h3>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                urlBase: '',
                urlBaseImg: '',
                veiculos: {},
                urlPaginacao: '',
            }
        },
        methods: {
            formatarTituloParaLink(nome) {
                return nome.normalize('NFD').replace(/[\u0300-\u036f]/g, "").toLowerCase().replace(/[- ]+/g, "-").replace(/[. ]/g, "-");
            },
            paginacao(links){
                if(links.url){
                    this.urlPaginacao = links.url.split('?')[1]; //ajustando a url de consulta com o parametro de pagina
                    this.carregarListaVeiculos('');  //requisitando novamente os dados para a API com a paginacao 
                }
            },
            carregarListaVeiculos(urlFiltro = ''){
                let url = this.urlBase + '/veiculos/lista' + '?' +this.urlPaginacao + urlFiltro;
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
        },
        created() {
            this.urlBase = import.meta.env.VITE_API_URL_SITE;
            this.urlBaseImg = import.meta.env.VITE_URL_BASE_IMG;
            this.carregarListaVeiculos();
        }
    }
</script>
