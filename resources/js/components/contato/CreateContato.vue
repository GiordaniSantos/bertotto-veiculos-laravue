<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <!-- Card de listagem -->
                <card-component titulo="Criar Contato">
                    <template v-slot:conteudo>
                        <div class="row">
                            <div class="col-12 form-group">
                                <input-container-component titulo="Nome" id="novoNome" idHelp="novoNomeHelp" texto-ajuda="Informe o nome do contato">
                                    <input type="text" class="form-control" id="novoNome" aria-describedby="novoNomeHelp" placeholder="Nome do Contato" v-model="nome">
                                </input-container-component>
                                {{ nome }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 form-group">
                                <input-container-component titulo="Email" id="novoEmail" idHelp="novoEmailHelp" texto-ajuda="Informe o email do contato">
                                    <input type="text" class="form-control" id="novoEmail" aria-describedby="novoEmailHelp" placeholder="Email do Contato" v-model="email">
                                </input-container-component>
                                {{ email }}
                            </div>
                            <div class="col-6 form-group">
                                <input-container-component titulo="Telefone" id="telefone" idHelp="telefoneHelp" texto-ajuda="Informe o telefone do contato">
                                    <input type="text" class="form-control" id="telefone" aria-describedby="telefoneHelp" placeholder="Telefone do Contato" v-model="telefone">
                                </input-container-component>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <input-container-component titulo="Mensagem" id="mensagem" idHelp="mensagemHelp" texto-ajuda="Informe o mensagem do contato">
                                    <textarea name="mensagem" class="form-control" placeholder="Mensagem" id="mensagem" aria-describedby="mensagemHelp" style="width: 100% !important;" rows="4" cols="50" v-model="mensagem"></textarea>
                                </input-container-component>
                                {{ mensagem }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2">
                                <input-container-component titulo="Ativo" id="ativo" idHelp="ativoHelp" >
                                    <input type="checkbox" id="ativo" name="ativo" aria-describedby="ativoHelp" v-model="ativo">
                                </input-container-component>
                                {{ ativo }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <input-container-component titulo="Resposta" id="resposta" idHelp="respostaHelp" texto-ajuda="Resposta do contato">
                                    <textarea name="resposta" class="form-control" placeholder="resposta" id="resposta" aria-describedby="respostaHelp" style="width: 100% !important;" rows="4" cols="50" v-model="resposta"></textarea>
                                </input-container-component>
                            </div>
                            <div class="col-4">
                                <input-container-component titulo="Status" id="status" idHelp="statusHelp" >
                                    <select name="status" style="width: 100%;" v-model="status">
                                        <option> Selecione </option>
                                        <option value="1"> Aberto </option>
                                        <option value="2"> Respondido </option>
                                    </select>
                                </input-container-component>
                                {{ status }}
                            </div>
                        </div>
                    </template>
                    <template v-slot:rodape>
                        <a href="/admin/contatos" class="btn btn-primary btn-sm">Listar</a>
                        <button type="submit" class="btn btn-primary btn-sm" style="float: right;" @click="salvar()">Criar</button>
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
                nome: '',
                email: '',
                telefone: '',
                mensagem: '',
                ativo: '',
                resposta: '',
                status: ''
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
            salvar(){
                console.log('teste')

                let formData = new FormData();
                formData.append('nome', this.nome);
                formData.append('email', this.email);
                formData.append('telefone', this.telefone);
                formData.append('mensagem', this.mensagem);
                formData.append('ativo', this.ativo);
                formData.append('resposta', this.resposta);
                formData.append('status', this.status);

                let config = {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        'Accept': 'application/json',
                        'Authorization': this.token
                    }
                }

                axios.post(this.urlBase, formData, config)
                    .then(response => {
                        console.log(response)
                    })  
                    .catch(errors => {
                        console.log(errors)
                    })
            }
        }
    }
</script>
