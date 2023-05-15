<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">

                <!-- Card de listagem -->
                <card-component titulo="Criar Banner">
                    <template v-slot:conteudo>
                        <div class="row">
                            <div class="col-12 form-group">
                                <input-container-component titulo="Titulo" id="novoTitulo" idHelp="novoTituloHelp">
                                    <input type="text" class="form-control" id="novoTitulo" aria-describedby="novoTituloHelp" placeholder="Titulo do banner" v-model="titulo">
                                </input-container-component>
                      
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-12 form-group">
                                <input-container-component titulo="Link" id="novoLink" idHelp="novoLinkHelp">
                                    <input type="text" class="form-control" id="novoLink" aria-describedby="novoLinkHelp" placeholder="Link do banner" v-model="link">
                                </input-container-component>
                          
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-12 form-group">
                                <input-container-component id="novoImagem" id-help="novoImagemHelp">
                                    <br>
                                    <input type="file" class="form-control-file" id="novoImagem" aria-describedby="novoImagemHelp" placeholder="Selecione uma imagem" @change="carregarImagem($event)">
                                </input-container-component>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <img id="output"/>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-3">
                                <input-container-component titulo="Ativo" id="ativo" idHelp="ativoHelp" >
                                    <input type="checkbox" id="ativo" name="ativo" aria-describedby="ativoHelp" v-model="ativo">
                                </input-container-component>
                            </div>
                            <div class="col-3">
                                <input-container-component titulo="Nova Guia" id="novaGuia" idHelp="novaGuiaHelp" >
                                    <input type="checkbox" id="novaGuia" name="novaGuia" aria-describedby="novaGuiaHelp" v-model="nova_guia">
                                </input-container-component>
                            </div>
                            <div class="col-3">
                                <input-container-component titulo="Ordem" id="ordem" idHelp="ordemHelp" >
                                    <input type="number" id="ordem" name="ordem" aria-describedby="ordemHelp" v-model="ordem">
                                </input-container-component>
                            </div>
                        </div>
                    </template>
                    <template v-slot:rodape>
                        <a href="/admin/banners" class="btn btn-primary btn-sm">Listar</a>
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
                urlBase: 'http://localhost:8000/api/v1/banner',
                titulo: '',
                link: '',
                arquivoImagem: [],
                ativo: '',
                nova_guia: '',
                ordem: ''
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
                let formData = new FormData();
                formData.append('titulo', this.titulo);
                formData.append('link', this.link);
                formData.append('arquivo', this.arquivoImagem[0])
                formData.append('ativo', this.ativo ? 1 : 0);
                formData.append('nova_guia', this.nova_guia ? 1 : 0);
                formData.append('ordem', this.ordem);

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
                        this.$swal("Sucesso", "Registro cadastrado com sucesso!", "success");
                    })  
                    .catch(errors => {
                        console.log(errors)
                        this.$swal("Oops...", "Algum erro aconteceu! " +errors.response.data.message, "error");
                    })
            },
            carregarImagem(e) {
                this.arquivoImagem = e.target.files
            },
        }
    }
</script>
