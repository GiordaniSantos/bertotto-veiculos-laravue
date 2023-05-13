<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

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
                        <table class="table">
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
                                    <td>{{ banner.ordem }}</td>
                                    <td>{{ banner.ativo ? 'Sim' : 'Não' }}</td>
                                    <td>
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#showModal" @click="findBanner(banner.id)">Visualizar</button>
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateModal" @click="findBanner(banner.id)">Editar</button>
                                        <button type="button" class="btn btn-danger">Delete</button>
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
                                <paginate-component>
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
                            ID: {{bannerBuscado.id}} <br>
                            Titulo: {{bannerBuscado.titulo}} <br>
                            Link: {{ bannerBuscado.link }} <br>
                            Ativo: {{ bannerBuscado.ativo ? 'Sim' : 'Não' }} <br>
                            Nova guia: {{ bannerBuscado.nova_guia ? 'Sim' : 'Não' }} <br>
                            Data de Criação: {{ bannerBuscado.created_at }} <br>
                            Data de Modificação: {{ bannerBuscado.updated_at }} <br><br>
                            <a :href="urlBaseImg" target="_blank"><img :src="urlBaseImg" alt="Banner" style="width: 100%;"></a>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Update -->
                <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
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
                                        <div class="form-group">
                                            <label>Link</label>
                                            <input type="text" class="form-control" v-model="bannerBuscado.link">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-2">
                                            <input type="checkbox" id="ativo" v-model="bannerBuscado.ativo">
                                            <label for="ativo">Ativo</label>
                                        </div>
                                        <div class="col-2">
                                            <input type="checkbox" id="nova_guia" v-model="bannerBuscado.nova_guia">
                                            <label for="nova_guia">Nova Guia</label>
                                        </div>
                                        <div class="col-2">
                                            <label>Ordem</label>
                                            <input type="number" class="form-control" v-model="bannerBuscado.ordem">
                                        </div>
                                    </div>
                                </div>                        
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                            <button type="button" class="btn btn-primary" @click="atualizar()">Salvar alterações</button>
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
                urlBase: 'http://localhost:8000/api/v1/banner',
                urlBaseImg: 'http://localhost:8000',
                urlPaginacao: '',
                urlFiltro: '',
                imagemBannerBuscado: {},
                nome: '',
                ativo: '',
                banners: { data: [] },
                bannerBuscado: { },
                busca: { titulo:'' }
            }
        },
        computed: {
            token(){
                //pegando o token JWT do cookie
                let token = document.cookie.split(';').find(indice => {
                    return indice.includes('token=');
                });

                token = token.split('=')[1];
                token = 'Bearer ' + token;

                return token;
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
            carregarLista(){

                let url = this.urlBase + '?' +this.urlPaginacao + this.urlFiltro;
                
                let config = {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        'Accept': 'application/json',
                        'Authorization': this.token
                    }
                }

                axios.get(url, config)
                    .then(response => {
                        this.banners  = response.data;
                        console.log(this.banners);
                    })
                    .catch(errors => {
                        this.$swal("Oops...", "Algum erro aconteceu! " +errors.response.data.message, "error");
                    });
            },
            findBanner(id){

                let url = this.urlBase + '/' +id;
                let config = {
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': this.token
                    }
                }
                if(this.urlBaseImg != ''){
                    this.urlBaseImg = '';
                }

                if(this.bannerBuscado){
                    this.bannerBuscado = {};
                }

                axios.get(url, config)
                    .then(response => {
                        this.bannerBuscado  = response.data;
                        if(response.data.arquivo){
                            this.imagemBannerBuscado = response.data.arquivo;
                            this.urlBaseImg = this.urlBaseImg+ "/storage/uploads/banner/"+response.data.arquivo.id+"/"+response.data.arquivo.arquivo;
                        }
                    })
                    .catch(errors => {
                        this.$swal("Oops...", "Algum erro aconteceu! " +errors.response.data.message, "error");
                    });
            },
            atualizar(){
                let url = this.urlBase + '/' +this.bannerBuscado.id;
                let formData = new FormData();
                formData.append('titulo', this.bannerBuscado.titulo);
                formData.append('link', this.bannerBuscado.link);
                formData.append('ativo', this.bannerBuscado.ativo ? 1 : 0);
                formData.append('nova_guia', this.bannerBuscado.nova_guia ? 1 : 0);
                formData.append('ordem', this.bannerBuscado.ordem);
                formData.append('_method', 'patch');

                let config = {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        'Accept': 'application/json',
                        'Authorization': this.token
                    }
                }

                axios.post(url, formData, config)
                    .then(response => {
                        console.log(response)
                        this.$swal("Sucesso", "Registro atualizado com sucesso!", "success");
                    })  
                    .catch(errors => {
                        console.log(errors)
                        this.$swal("Oops...", "Algum erro aconteceu! " +errors.response.data.message, "error");
                    })
                
                this.carregarLista();
            }
        },
        mounted() {
            this.carregarLista();
        }
    }
</script>
