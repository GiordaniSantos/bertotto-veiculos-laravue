<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">

                <!-- Card de Busca -->
                <card-component titulo="Buscar Contatos">
                    <template v-slot:conteudo>
                        <div class="row">
                            <div class="col-6 form-group">
                                <input-container-component titulo="Email" id="inputEmail" idHelp="emailHelp" texto-ajuda="Opcional. Informe o email do contato">
                                    <input type="email" class="form-control" id="inputEmail" aria-describedby="emailHelp" placeholder="Email do Contato" v-model="busca.email">
                                </input-container-component>
                            </div>
                            <div class="col-6 form-group">
                                <input-container-component titulo="Nome do Contato" id="inputnome" idHelp="nomeHelp" texto-ajuda="Opcional. Informe o nome do contato">
                                    <input type="text" class="form-control" id="inputNome" aria-describedby="nomeHelp" placeholder="Nome do Contato" v-model="busca.nome">
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
                <card-component titulo="Contatos">
                    <template v-slot:conteudo>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Telefone</th>
                                    <th>Data de Abertura</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody v-if="contatos.data.length > 0">
                                <tr v-for="(contato,key) in contatos.data" :key="key">
                                    <td>{{ contato.nome }}</td>
                                    <td>{{ contato.telefone }} </td>
                                    <td>{{ formataDataTempo(contato.created_at) }} </td>
                                    <td><span v-html="getStatusLabel(contato)"></span></td>
                                    <td>
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#showModal" @click="findContato(contato.id)"><i class="fa-solid fa-eye"></i></button>
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateModal" @click="findContato(contato.id)"><i class="fa-solid fa-pen"></i></button>
                                        <button type="button" class="btn btn-danger" @click="deletar(contato.id)"><i class="fa-solid fa-trash"></i></button>
                                        
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
                                <paginate-component v-if="contatos.data.length == 10">
                                    <li v-for="link, key in contatos.links" :key="key" :class="link.active ? 'page-item active' : 'page-item'" @click="paginacao(link)">
                                        <a class="page-link" v-html="link.label"></a>
                                    </li>
                                </paginate-component>
                            </div>
                            <div class="col-2">
                                <a href="/admin/contato/create" class="btn btn-primary btn-sm" style="float: right;">Adicionar</a>
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
                            <h5 class="modal-title" id="showModalLabel" v-if="contatoBuscado.nome">Visualizar: {{ contatoBuscado.nome }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-striped table-hover">
                                <tr>
                                    <td>ID:</td>
                                    <td>{{ contatoBuscado.id }}</td>
                                </tr>
                                <tr>
                                    <td>Nome:</td>
                                    <td>{{ contatoBuscado.nome }}</td>
                                </tr>
                                <tr>
                                    <td>Status:</td>
                                    <td>{{ contatoBuscado.status == 1 ? 'Aberto' : 'Respondido' }}</td>
                                </tr>
                                <tr>
                                    <td>E-mail:</td>
                                    <td>{{contatoBuscado.email}}</td>
                                </tr>
                                <tr>
                                    <td>Telefone:</td>
                                    <td>{{contatoBuscado.telefone}}</td>
                                </tr>
                                <tr>
                                    <td>Mensagem:</td>
                                    <td>{{contatoBuscado.mensagem}}</td>
                                </tr>
                                <tr>
                                    <td>Ativo:</td>
                                    <td>{{ contatoBuscado.ativo ? 'Sim' : 'Não'  }}</td>
                                </tr>
                                <tr>
                                    <td>Resposta:</td>
                                    <td>{{contatoBuscado.resposta}}</td>
                                </tr>
                                <tr>
                                    <td>Data Resposta:</td>
                                    <td>{{ contatoBuscado.data_resposta }}</td>
                                </tr>
                                <tr>
                                    <td>Data Criação:</td>
                                    <td>{{ formataDataTempo(contatoBuscado.created_at) }}</td>
                                </tr>
                                <tr>
                                    <td>Data Modificação:</td>
                                    <td>{{ formataDataTempo(contatoBuscado.updated_at) }}</td>
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
                            <h5 class="modal-title" id="updateModalLabel" v-if="contatoBuscado.nome">Editar: {{ contatoBuscado.nome }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="row">
                                    <div class="col-12 form-group">
                                        <input-container-component titulo="Nome" id="novoNome" idHelp="novoNomeHelp">
                                            <input type="text" class="form-control" id="novoNome" aria-describedby="novoNomeHelp" placeholder="Nome do Contato" v-model="contatoBuscado.nome" disabled>
                                        </input-container-component>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-6 form-group">
                                        <input-container-component titulo="Email" id="novoEmail" idHelp="novoEmailHelp">
                                            <input type="text" class="form-control" id="novoEmail" aria-describedby="novoEmailHelp" placeholder="Email do Contato" v-model="contatoBuscado.email" disabled>
                                        </input-container-component>
                                    </div>
                                    <div class="col-6 form-group">
                                        <input-container-component titulo="Telefone" id="telefone" idHelp="telefoneHelp">
                                            <input type="text" class="form-control" id="telefone" aria-describedby="telefoneHelp" placeholder="Telefone do Contato" v-model="contatoBuscado.telefone" disabled>
                                        </input-container-component>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-12">
                                        <input-container-component titulo="Mensagem" id="mensagem" idHelp="mensagemHelp">
                                            <textarea name="mensagem" class="form-control" placeholder="Mensagem" id="mensagem" aria-describedby="mensagemHelp" style="width: 100% !important;" rows="4" cols="50" v-model="contatoBuscado.mensagem" disabled></textarea>
                                        </input-container-component>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-2">
                                        <input-container-component titulo="Ativo" id="ativo" >
                                            <input type="checkbox" id="ativo"  v-model="ativo" disabled>
                                        </input-container-component>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-8">
                                        <input-container-component titulo="Resposta" id="resposta" idHelp="respostaHelp" texto-ajuda="Resposta para o contato">
                                            <textarea name="resposta" class="form-control" placeholder="resposta" id="resposta" aria-describedby="respostaHelp" style="width: 100% !important;" rows="4" cols="50" v-model="contatoBuscado.resposta"></textarea>
                                        </input-container-component>
                                    </div>
                                    <div class="col-4">
                                        <input-container-component titulo="Status" id="status" idHelp="statusHelp" >
                                            <select name="status" style="width: 100%;" v-model="contatoBuscado.status">
                                                <option> Selecione </option>
                                                <option value="1"> Aberto </option>
                                                <option value="2"> Respondido </option>
                                            </select>
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
                urlBase: 'http://localhost:8000/api/v1/contato',
                urlPaginacao: '',
                urlFiltro: '',
                nome: '',
                email: '',
                telefone: '',
                mensagem: '',
                ativo: false,
                resposta: '',
                status: '',
                contatos: { data: [] },
                contatoBuscado: { },
                busca: { email:'', nome:'' }
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
                        this.contatos  = response.data;
                        this.$swal.close();
                    })
                    .catch(errors => {
                        console.log(errors);
                    });
            },
            findContato(id){

                let url = this.urlBase + '/' +id;

                if(this.contatoBuscado){
                    this.contatoBuscado = {};
                }
                this.$swal.showLoading();
                axios.get(url)
                    .then(response => {
                        this.contatoBuscado  = response.data;
                        this.ativo = this.contatoBuscado.ativo == 1 ? true : false;
                        this.$swal.close();
                    })
                    .catch(errors => {
                        this.$swal("Oops...", "Algum erro aconteceu! " +errors.response.data.message, "error");
                    });
                    console.log(this.contatoBuscado.ativo)
                
            },
            atualizar(){
                let url = this.urlBase + '/' +this.contatoBuscado.id;
                let formData = new FormData();
                formData.append('resposta', this.contatoBuscado.resposta);
                formData.append('status', this.contatoBuscado.status);
                formData.append('_method', 'patch');

                let config = {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    }
                }

                axios.post(url, formData, config)
                    .then(response => {
                        this.$swal("Sucesso", "Registro atualizado com sucesso!", "success");
                        this.findContato(response.data.id);
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
            getStatusLabel(contato){
                let statusContato = contato.status == 1 ? 'Aberto' : 'Respondido';
                let classCss = 'default';

                if(contato.status == 1){
                    classCss = 'danger';
                }else {
                    classCss = 'success';
                }

                let label = '<span class="radius4 fontBranco text-uppercase label-'+classCss+'" style="font-size:.8em; letter-spacing:0.5px; padding:6px 12px; white-space:nowrap"><small>'+statusContato+'</small></span>';
                return label;
                
            }
        },
        mounted() {
            this.carregarLista();
        }
    }
</script>
