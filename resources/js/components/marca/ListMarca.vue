<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">

                <!-- Card de listagem -->
                <card-component titulo="Marcas">
                    <template v-slot:conteudo>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody v-if="marcas.data.length > 0">
                                <tr v-for="(marca,key) in marcas.data" :key="key">
                                    <td>{{ marca.nome }}</td>
                                    <td>
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#showModal" @click="findMarca(marca.id)"><i class="fa-solid fa-eye"></i></button>
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateModal" @click="findMarca(marca.id)"><i class="fa-solid fa-pen"></i></button>
                                        <button type="button" class="btn btn-danger" @click="deletar(marca.id)"><i class="fa-solid fa-trash"></i></button>
                                        
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
                                <paginate-component v-if="marcas.data.length == 10">
                                    <li v-for="link, key in marcas.links" :key="key" :class="link.active ? 'page-item active' : 'page-item'" @click="paginacao(link)">
                                        <a class="page-link" v-html="link.label"></a>
                                    </li>
                                </paginate-component>
                            </div>
                            <div class="col-2">
                                <a href="/admin/marca/create" class="btn btn-primary btn-sm" style="float: right;">Adicionar</a>
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
                            <h5 class="modal-title" id="showModalLabel" v-if="marcaBuscado.nome">Visualizar: {{ marcaBuscado.nome }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-striped table-hover">
                                <tr>
                                    <td>ID:</td>
                                    <td>{{ marcaBuscado.id }}</td>
                                </tr>
                                <tr>
                                    <td>Nome:</td>
                                    <td>{{ marcaBuscado.nome }}</td>
                                </tr>
                                <tr>
                                    <td>Data Criação:</td>
                                    <td>{{ formataDataTempo(marcaBuscado.created_at) }}</td>
                                </tr>
                                <tr>
                                    <td>Data Modificação:</td>
                                    <td>{{ formataDataTempo(marcaBuscado.updated_at) }}</td>
                                </tr>
                            </table>
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
                            <h5 class="modal-title" id="updateModalLabel" v-if="marcaBuscado.nome">Editar: {{ marcaBuscado.nome }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="row">
                                    <div class="col-12 form-group">
                                        <input-container-component titulo="Nome" id="novoNome" idHelp="novoNomeHelp">
                                            <input type="text" class="form-control" id="novoNome" aria-describedby="novoNomeHelp" placeholder="Nome do Marca" v-model="marcaBuscado.nome">
                                        </input-container-component>
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
                urlBase: 'http://localhost:8000/api/v1/marca',
                urlPaginacao: '',
                urlFiltro: '',
                nome: '',
                marcas: { data: [] },
                marcaBuscado: { },
            }
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

                this.$swal.showLoading();

                axios.get(url)
                    .then(response => {
                        this.marcas  = response.data;
                        this.$swal.close();
                    })
                    .catch(errors => {
                        console.log(errors);
                    });
            },
            findMarca(id){

                let url = this.urlBase + '/' +id;

                if(this.marcaBuscado){
                    this.marcaBuscado = {};
                }
                this.$swal.showLoading();
                axios.get(url)
                    .then(response => {
                        this.marcaBuscado  = response.data;
                        this.$swal.close();
                    })
                    .catch(errors => {
                        this.$swal("Oops...", "Algum erro aconteceu! " +errors.response.data.message, "error");
                    });
            },
            atualizar(){
                let url = this.urlBase + '/' +this.marcaBuscado.id;
                let formData = new FormData();
                formData.append('nome', this.marcaBuscado.nome);
                formData.append('_method', 'put');

                let config = {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    }
                }

                axios.post(url, formData, config)
                    .then(response => {
                        this.$swal("Sucesso", "Registro atualizado com sucesso!", "success");
                        this.findMarca(response.data.id);
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
        },
        mounted() {
            this.carregarLista();
        }
    }
</script>
