<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

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
                        <table-component :visualizar="true" url-visualizar="/admin/contato/show" :editar="true" :excluir="true" :dados="contatos.data" :titulos="{
                            nome: {titulo: 'Nome', tipo: 'text'},
                            telefone: {titulo: 'Telefone', tipo: 'text'},
                            created_at: {titulo: 'Data de Abertura', tipo: 'data'},
                            status: {titulo: 'Status', tipo: 'text'}
                        }"></table-component>
                    </template>
                    <template v-slot:rodape>
                        <div class="row">
                            <div class="col-10">
                                <paginate-component>
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
                ativo: '',
                resposta: '',
                status: '',
                contatos: { data: [] },
                busca: { email:'', nome:'' }
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
                console.log(url);
                let config = {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        'Accept': 'application/json',
                        'Authorization': this.token
                    }
                }

                axios.get(url, config)
                    .then(response => {
                        this.contatos  = response.data;
                    })
                    .catch(errors => {
                        console.log(errors);
                    });
            }
        },
        mounted() {
            this.carregarLista();
        }
    }
</script>
