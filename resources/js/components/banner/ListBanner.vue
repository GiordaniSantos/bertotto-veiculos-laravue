<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">

                <!-- Card de Busca -->
                <card-component titulo="Buscar banners">
                    <template v-slot:conteudo>
                        <div class="row">
                            <div class="col-12 form-group">
                                <input-container-component titulo="Nome do Banner" id="inputnome" idHelp="nomeHelp" texto-ajuda="Opcional. Informe o titulo do Banner">
                                    <input type="text" class="form-control" id="inputNome" aria-describedby="nomeHelp" placeholder="Nome do Banner" v-model="busca.titulo">
                                </input-container-component>
                            </div>
                        </div>
                    </template>
                    <template v-slot:rodape>
                        <button type="submit" class="btn btn-primary btn-sm" style="float: right;" @click="pesquisar()">Pesquisar</button>
                    </template>
                </card-component>
                <!-- fim card de busca -->

                <!-- Card de listagem -->
                <card-component titulo="Banners">
                    <template v-slot:conteudo>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Titulo</th>
                                    <th>Ordem</th>
                                    <th>Ativo</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody v-if="banners.data.length > 0">
                                <tr v-for="(banner,key) in banners.data" :key="key">
                                    <td>{{ banner.titulo }}</td>
                                    <td>{{ banner.ordem }} </td>
                                    <td>{{ banner.ativo == 1 ? 'Sim' : 'Não' }}</td>
                                    <td>
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#showModal" @click="findBanner(banner.id)"><i class="fa-solid fa-eye"></i></button>
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateModal" @click="findBanner(banner.id)"><i class="fa-solid fa-pen"></i></button>
                                        <button type="button" class="btn btn-danger" @click="deletar(banner.id)"><i class="fa-solid fa-trash"></i></button>
                                        
                                    </td>
                                </tr>
                            </tbody>
                            <tbody v-else>
                                <tr>
                                    <td colspan="4" align="center">Não há registros.</td>
                                </tr>
                            </tbody>
                        </table>
                    </template>
                    <template v-slot:rodape>
                        <div class="row">
                            <div class="col-10">
                                <paginate-component v-if="banners.data.length == 10">
                                    <li v-for="link, key in banners.links" :key="key" :class="link.active ? 'page-item active' : 'page-item'" @click="paginacao(link)">
                                        <a class="page-link" v-html="link.label"></a>
                                    </li>
                                </paginate-component>
                            </div>
                            <div class="col-2">
                                <a href="/admin/banner/create" class="btn btn-primary btn-sm" style="float: right;">Adicionar</a>
                            </div>
                        </div>
                    </template>
                </card-component>
                <!-- fim da listagem -->

                <!-- Modal Show -->
                <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="showModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="showModalLabel" v-if="bannerBuscado.titulo">Visualizar: {{ bannerBuscado.titulo }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-striped table-hover">
                                <tr>
                                    <td>ID:</td>
                                    <td>{{ bannerBuscado.id }}</td>
                                </tr>
                                <tr>
                                    <td>Titulo:</td>
                                    <td>{{ bannerBuscado.titulo }}</td>
                                </tr>
                                <tr>
                                    <td>Link:</td>
                                    <td>{{ bannerBuscado.link == null ? bannerBuscado.link : '' }}</td>
                                </tr>
                                <tr>
                                    <td>Ativo:</td>
                                    <td>{{ bannerBuscado.ativo ? 'Sim' : 'Não' }}</td>
                                </tr>
                                <tr>
                                    <td>Nova Guia:</td>
                                    <td>{{ bannerBuscado.nova_guia ? 'Sim' : 'Não'  }}</td>
                                </tr>
                                <tr>
                                    <td>Data Criação:</td>
                                    <td>{{ formataDataTempo(bannerBuscado.created_at) }}</td>
                                </tr>
                                <tr>
                                    <td>Data Modificação:</td>
                                    <td>{{ formataDataTempo(bannerBuscado.updated_at) }}</td>
                                </tr>
                            </table>
                            <div v-if="!isEmpty(imagemBannerBuscado)" class="row">
                                <div class="col-12">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Arquivo</th>
                                                <th>Nome</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><a :href="urlBaseImg" target="_blank"><img :src="urlBaseImg" alt="Banner" style="width: 100%;"></a></td>
                                                <th>{{ imagemBannerBuscado.nome_original  }}</th>
                                                <th><button type="button" class="btn btn-danger" @click="deletarArquivo(imagemBannerBuscado.id)"><i class="fa-solid fa-trash"></i></button></th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Update -->
                <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="updateModalLabel" v-if="bannerBuscado.titulo">Editar: {{ bannerBuscado.titulo }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Título</label>
                                            <input type="text" class="form-control" v-model="bannerBuscado.titulo">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group" style="margin-top: 10px;">
                                            <label>Link</label>
                                            <input type="text" class="form-control" v-model="bannerBuscado.link">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 form-group" style="margin-top: 10px;">
                                            <input-container-component id="novoImagem" id-help="novoImagemHelp">
                                                <br>
                                                <input type="file" class="form-control-file" id="novoImagem" aria-describedby="novoImagemHelp" placeholder="Selecione uma imagem" @change="carregarImagem($event)">
                                            </input-container-component>
                                        </div>
                                    </div>
                                    <br><br>
                                    <div class="row" style="margin-top: 15px;">
                                        <div class="col-4">
                                            <input type="checkbox" id="ativo" v-model="ativo">
                                            <label for="ativo">Ativo</label>
                                        </div>
                                        <div class="col-4">
                                            <input type="checkbox" id="nova_guia" v-model="nova_guia">
                                            <label for="nova_guia">Nova Guia</label>
                                        </div>
                                        <div class="col-4">
                                            <label>Ordem</label>
                                            <input type="number" class="form-control" v-model="bannerBuscado.ordem">
                                        </div>
                                    </div>
                                    <br><br>
                                    <div v-if="!isEmpty(imagemBannerBuscado)" class="row">
                                        <div class="col-12">
                                            <table class="table table-striped table-bordered" style="margin-top: 30px;">
                                                <thead>
                                                    <tr>
                                                        <th>Arquivo</th>
                                                        <th>Nome</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><a :href="urlBaseImg" target="_blank"><img :src="urlBaseImg" alt="Banner" style="width: 100%;"></a></td>
                                                        <th>{{ imagemBannerBuscado.nome_original  }}</th>
                                                        <th><button type="button" class="btn btn-danger" @click="deletarArquivo(imagemBannerBuscado.id)"><i class="fa-solid fa-trash"></i></button></th>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>                        
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                            <button type="button" class="btn btn-success" @click="atualizar()">Salvar alterações</button>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default{
        data(){
            return {
                urlBase: '',
                urlBaseImg: '',
                urlExcluirArquivo: '',
                urlPaginacao: '',
                urlFiltro: '',
                imagemBannerBuscado: {},
                arquivoImagem: [],
                nome: '',
                ativo: false,
                nova_guia: false,
                banners: { data: [] },
                bannerBuscado: { },
                busca: { titulo:'' }
            }
        },
        methods: {
            isEmpty(obj) {
                for(var prop in obj) {
                    if(obj.hasOwnProperty(prop))
                        return false;
                }

                return true;
            },
            formataDataTempo(d){
                if(!d) return ''

                d = d.split('T');

                let data = d[0];
                let tempo = d[1];

                data = data.split('-');

                //formatando a data
                data = data[2] + "/" + data[1] + "/" + data[0];

                //formatando o tempo
                tempo = tempo.split('.');
                tempo = tempo[0];

                return data + ' às ' + tempo;
            },
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
            carregarLista(){

                let url = this.urlBase + '?' +this.urlPaginacao + this.urlFiltro;
                
                let config = {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }

                this.$swal.showLoading();

                axios.get(url, config)
                    .then(response => {
                        this.banners  = response.data;
                        this.$swal.close();
                        console.log(this.banners);
                    })
                    .catch(errors => {
                        this.$swal("Oops...", "Algum erro aconteceu! " +errors.response.data.message, "error");
                    });
            },
            findBanner(id){

                let url = this.urlBase + '/' +id;

                if(this.urlBaseImg != ''){
                    this.urlBaseImg = '';
                }

                if(this.bannerBuscado){
                    this.bannerBuscado = {};
                }

                axios.get(url)
                    .then(response => {
                        this.bannerBuscado  = response.data;
                        if(response.data.arquivo){
                            this.imagemBannerBuscado = response.data.arquivo;
                            this.urlBaseImg = this.urlBaseImg+ "/storage/uploads/banner/"+response.data.arquivo.id+"/"+response.data.arquivo.arquivo;
                        }
                        this.ativo = this.bannerBuscado.ativo == 1 ? true : false;
                        this.nova_guia = this.bannerBuscado.nova_guia == 1 ? true : false;
                    })
                    .catch(errors => {
                        this.$swal("Oops...", "Algum erro aconteceu! " +errors.response.data.message, "error");
                    });
            },
            atualizar(){
                let url = this.urlBase + '/' +this.bannerBuscado.id;
                let formData = new FormData();
                formData.append('titulo', this.bannerBuscado.titulo);
                formData.append('link', this.bannerBuscado.link ? this.bannerBuscado.link : '');
                if(this.arquivoImagem[0]){
                    formData.append('arquivo', this.arquivoImagem[0])
                }
                formData.append('ativo', this.ativo == true ? 1 : 0);
                formData.append('nova_guia', this.nova_guia == true ? 1 : 0);
                formData.append('ordem', this.bannerBuscado.ordem);
                formData.append('_method', 'patch');

                let config = {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    }
                }

                axios.post(url, formData, config)
                    .then(response => {
                        if(response.data.arquivo){
                            this.imagemBannerBuscado = response.data.arquivo;
                            this.urlBaseImg = this.urlBaseImg+ "/storage/uploads/banner/"+response.data.arquivo.id+"/"+response.data.arquivo.arquivo;
                        }
                        document.getElementById("novoImagem").value = '';
                        this.$swal("Sucesso", "Registro atualizado com sucesso!", "success");
                        this.findBanner(response.data.id);
                    })  
                    .catch(errors => {
                        console.log(errors)
                        this.$swal("Oops...", "Algum erro aconteceu! " +errors.response.data.message +"/" +errors.message, "error");
                    })
                
              this.carregarLista();
            },
            deletar(id) {

                let config = {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    }
                }
                
                let formData = new FormData();
                formData.append('_method', 'delete');

                let url = this.urlBase + '/' + id;
                
                this.$swal({
                    title: 'Tem certeza que deseja excluir este registro?',
                    showConfirmButton: true,
                    showCancelButton: true,
                    confirmButtonText: "OK",
                    cancelButtonText: "Cancelar",
                    icon: 'warning'
                }
                ).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        axios.post(url, formData, config)
                            .then(response => {                        
                                this.$swal("Sucesso", "Registro removido com sucesso!", "success");
                                this.carregarLista()
                            })
                            .catch(errors => {
                                this.$swal("Oops...", "Algum erro aconteceu! " +errors.response.data.message, "error");
                            })
        
                    } else
                        this.$swal('Cancelado', '', 'error')
        
                })
          
            },
            deletarArquivo(id) {

                let config = {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    }
                }

                let formData = new FormData();
                formData.append('_method', 'delete');

                let url = this.urlExcluirArquivo + id + "/banner";
                console.log(url);
                this.$swal({
                    title: 'Tem certeza que deseja excluir este arquivo?',
                    showConfirmButton: true,
                    showCancelButton: true,
                    confirmButtonText: "OK",
                    cancelButtonText: "Cancelar",
                    icon: 'warning'
                }
                ).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        axios.post(url, formData, config)
                            .then(response => {                        
                                this.$swal("Sucesso", "Arquivo removido com sucesso!", "success");
                                document.getElementById("novoImagem").value = '';
                                this.imagemBannerBuscado = {};
                            })
                            .catch(errors => {
                                console.log(errors);
                                this.$swal("Oops...", "Algum erro aconteceu! " +errors.response.data.message, "error");
                            })

                    } else
                        this.$swal('Cancelado', '', 'error')

                })

                },
            carregarImagem(e) {
                this.arquivoImagem = e.target.files
            },
        },
        mounted() {
            this.urlBase = import.meta.env.VITE_API_URL + "/banner";
            this.urlBaseImg = import.meta.env.VITE_URL_BASE_IMG;
            this.urlExcluirArquivo = import.meta.env.VITE_API_URL + "/arquivo/excluir/";
            this.carregarLista();
        }
    }
</script>
