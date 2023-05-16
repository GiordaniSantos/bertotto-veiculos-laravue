<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">

                <!-- Card de Busca -->
                <card-component titulo="Buscar veiculos">
                    <template v-slot:conteudo>
                        <div class="row">
                            <div class="col-12 form-group">
                                <input-container-component titulo="Nome do Veículo" id="inputnome" idHelp="nomeHelp" texto-ajuda="Opcional. Informe o nome do veículo">
                                    <input type="text" class="form-control" id="inputNome" aria-describedby="nomeHelp" placeholder="Nome do Veículo" v-model="busca.nome">
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
                <card-component titulo="Veículos">
                    <template v-slot:conteudo>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Ativo</th>
                                    <th>Destaque</th>
                                    <th>Recomendado</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody v-if="veiculos.data.length > 0">
                                <tr v-for="(veiculo,key) in veiculos.data" :key="key">
                                    <td>{{ veiculo.nome }}</td>
                                    <td>{{ veiculo.ativo ? 'Sim' : 'Não' }} </td>
                                    <td>{{ veiculo.destaque ? 'Sim' : 'Não' }}</td>
                                    <td>{{ veiculo.recomendado ? 'Sim' : 'Não' }}</td>
                                    <td>
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#showModal" @click="findBanner(veiculo.id)"><i class="fa-solid fa-eye"></i></button>
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateModal" @click="findBanner(veiculo.id)"><i class="fa-solid fa-pen"></i></button>
                                        <button type="button" class="btn btn-danger" @click="deletar(veiculo.id)"><i class="fa-solid fa-trash"></i></button>
                                        
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
                                    <li v-for="link, key in veiculos.links" :key="key" :class="link.active ? 'page-item active' : 'page-item'" @click="paginacao(link)">
                                        <a class="page-link" v-html="link.label"></a>
                                    </li>
                                </paginate-component>
                            </div>
                            <div class="col-2">
                                <a href="/admin/veiculo/create" class="btn btn-primary btn-sm" style="float: right;">Adicionar</a>
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
                            Link: {{ bannerBuscado.link == null ? bannerBuscado.link : '' }} <br>
                            Ativo: {{ bannerBuscado.ativo ? 'Sim' : 'Não' }} <br>
                            Nova guia: {{ bannerBuscado.nova_guia ? 'Sim' : 'Não' }} <br>
                            Data de Criação: {{ formataDataTempo(bannerBuscado.created_at) }} <br>
                            Data de Modificação: {{ formataDataTempo(bannerBuscado.updated_at) }} <br><br>
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
                                    <br>
                                    <a :href="urlBaseImg" target="_blank" style="margin-top: 15px;"><img :src="urlBaseImg" alt="Banner" style="width: 100%;"></a>
                                    <br>
                                    <div class="row" style="margin-top: 15px;">
                                        <div class="col-4">
                                            <input type="checkbox" id="ativo" v-model="bannerBuscado.ativo">
                                            <label for="ativo">Ativo</label>
                                        </div>
                                        <div class="col-4">
                                            <input type="checkbox" id="nova_guia" v-model="bannerBuscado.nova_guia">
                                            <label for="nova_guia">Nova Guia</label>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 8px;">
                                        <div class="col-4">
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
                urlBase: 'http://localhost:8000/api/v1/veiculo',
                urlBaseImg: 'http://localhost:8000',
                urlPaginacao: '',
                urlFiltro: '',
                imagemBannerBuscado: {},
                arquivoImagem: [],
                nome: '',
                ativo: '',
                veiculos: { data: [] },
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
            },

        },  
        methods: {
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
                        'Content-Type': 'multipart/form-data',
                        'Accept': 'application/json',
                        'Authorization': this.token
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
                formData.append('link', this.bannerBuscado.link ? this.bannerBuscado.link : '');
                formData.append('arquivo', this.arquivoImagem[0])
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
                        this.$swal("Sucesso", "Registro atualizado com sucesso!", "success");
                        this.urlBaseImg = this.urlBaseImg+ "/storage/uploads/banner/"+response.data.arquivo.id+"/"+response.data.arquivo.arquivo;
                        this.findBanner(response.data.id);
                        document.getElementById("novoImagem").value = '';
                    })  
                    .catch(errors => {
                        console.log(errors)
                        this.$swal("Oops...", "Algum erro aconteceu! " +errors.response.data.message, "error");
                    })
                
                this.carregarLista();
            },
            deletar(id) {

                let config = {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        'Accept': 'application/json',
                        'Authorization': this.token
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
            carregarImagem(e) {
                this.arquivoImagem = e.target.files
            },
        },
        mounted() {
            this.carregarLista();
        }
    }
</script>
