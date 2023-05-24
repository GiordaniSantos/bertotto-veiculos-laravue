<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">

                <!-- Card de listagem -->
                <card-component titulo="Editar Configurações">
                    <template v-slot:conteudo>
                        <div class="row">
                            <div class="col-12 form-group">
                                <input-container-component titulo="Nome" id="novoNome" idHelp="novoNomeHelp">
                                    <input type="text" class="form-control" id="novoNome" aria-describedby="novoNomeHelp" placeholder="Nome" v-model="nome">
                                </input-container-component>
                      
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-6 form-group">
                                <input-container-component titulo="Endereço" id="novoEndereco" idHelp="novoEnderecoHelp">
                                    <input type="text" class="form-control" id="novoEndereco" aria-describedby="novoEnderecoHelp" placeholder="Endereco" v-model="endereco">
                                </input-container-component>
                          
                            </div>
                            <div class="col-6 form-group">
                                <input-container-component titulo="Telefone" id="telefone" idHelp="telefoneHelp">
                                    <input type="text" class="form-control" id="telefone" aria-describedby="telefoneHelp" placeholder="Telefone" v-model="telefone">
                                </input-container-component>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-12 form-group">
                                <input-container-component titulo="Google Maps" id="googleMaps" idHelp="googleMapsHelp">
                                    <textarea name="googleMaps" class="form-control" placeholder="googleMaps" id="googleMaps" aria-describedby="googleMapsHelp" style="width: 100% !important;" rows="4" cols="50" v-model="googlemaps"></textarea>
                                </input-container-component>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-12 form-group">
                                <input-container-component titulo="Rodapé" id="rodape" idHelp="rodapeHelp">
                                    <textarea name="rodape" class="form-control" placeholder="rodape" id="rodape" aria-describedby="rodapeHelp" style="width: 100% !important;" rows="4" cols="50" v-model="rodape"></textarea>
                                    
                                </input-container-component>
                            </div>
                        </div>
                        <br>
                        <legend>Mídias Sociais</legend>
                        <div class="row">
                            <div class="col-6 form-group">
                                <input-container-component titulo="Instagram" id="instagram" idHelp="instagramHelp">
                                    <input type="text" class="form-control" id="instagram" aria-describedby="instagramHelp" placeholder="Instagram" v-model="instagram">
                                </input-container-component>
                          
                            </div>
                            <div class="col-6 form-group">
                                <input-container-component titulo="Twitter" id="novotwitter" idHelp="novotwitterHelp">
                                    <input type="text" class="form-control" id="novotwitter" aria-describedby="novotwitterHelp" placeholder="Twiiter" v-model="twitter">
                                </input-container-component>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 form-group">
                                <input-container-component titulo="Facebook" id="facebook" idHelp="facebookHelp">
                                    <input type="text" class="form-control" id="facebook" aria-describedby="facebookHelp" placeholder="Facebook" v-model="facebook">
                                </input-container-component>
                          
                            </div>
                            <div class="col-6 form-group">
                                <input-container-component titulo="Whatsapp" id="whatsapp" idHelp="whatsappHelp">
                                    <input type="text" class="form-control" id="whatsapp" aria-describedby="whatsappHelp" placeholder="Whatsapp" v-model="whatsapp">
                                </input-container-component>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 form-group">
                                <input-container-component titulo="Youtube" id="youtube" idHelp="youtubeHelp">
                                    <input type="text" class="form-control" id="youtube" aria-describedby="youtubeHelp" placeholder="Youtube" v-model="youtube">
                                </input-container-component>
                          
                            </div>
                            <div class="col-6 form-group">
                                <input-container-component titulo="Spotify" id="spotify" idHelp="spotifyHelp">
                                    <input type="text" class="form-control" id="spotify" aria-describedby="spotifyHelp" placeholder="Spotify" v-model="spotify">
                                </input-container-component>
                            </div>
                        </div>
                    </template>
                    <template v-slot:rodape>
                        <button type="submit" class="btn btn-success btn-sm" style="float: right;" @click="atualizar()">Atualizar</button>
                    </template>
                </card-component>
                <!-- fim da listagem -->
            </div>
        </div>
        
    </div>
</template>

<script>
    $("#telefone").mask("(00) 00000-0000");
    export default{
        
        data(){
            return {
                urlBase: '',
                nome: '',
                endereco: '',
                telefone: '',
                googlemaps: '',
                rodape: '',
                instagram: '',
                twitter: '',
                facebook: '',
                whatsapp: '',
                youtube: '',
                spotify: '',
            }
        }, 
        methods: {
            atualizar(){
                let formData = new FormData();
                formData.append('nome', this.nome ? this.nome : '');
                formData.append('endereco', this.endereco ? this.endereco : '');
                formData.append('telefone', this.telefone ? this.telefone : '');
                formData.append('googlemaps', this.googlemaps ? this.googlemaps : '');
                formData.append('rodape', this.rodape ? this.rodape : '');
                formData.append('instagram', this.instagram ? this.instagram : '');
                formData.append('twitter', this.twitter ? this.twitter : '');
                formData.append('facebook', this.facebook ? this.facebook : '');
                formData.append('whatsapp', this.whatsapp ? this.whatsapp : '');
                formData.append('youtube', this.youtube ? this.youtube : '');
                formData.append('spotify', this.spotify ? this.spotify : '');
                formData.append('_method', 'patch');

                let config = {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    }
                }

                axios.post(this.urlBase, formData, config)
                    .then(response => {
                        this.$swal("Sucesso", "Configurações atualizadas com sucesso!", "success");
                    })  
                    .catch(errors => {
                        console.log(errors)
                        this.$swal("Oops...", "Algum erro aconteceu! " +errors.response.data.message, "error");
                    })
            },
            findConfiguracao(){

            this.$swal.showLoading();

            axios.get(this.urlBase)
                .then(response => {
                    this.nome = response.data.nome;
                    this.endereco = response.data.endereco;
                    this.telefone = response.data.telefone;
                    this.googlemaps = response.data.googlemaps;
                    this.rodape = response.data.rodape;
                    this.instagram = response.data.instagram;
                    this.twitter = response.data.twitter;
                    this.facebook = response.data.facebook;
                    this.whatsapp = response.data.whatsapp;
                    this.youtube = response.data.youtube;
                    this.spotify = response.data.spotify;
                    this.$swal.close();
                })
                .catch(errors => {
                    this.$swal("Oops...", "Algum erro aconteceu! " +errors.response.data.message, "error");
                });
            },
        },
        mounted() {
            this.urlBase = import.meta.env.VITE_API_URL + "/configuracao/1";
            this.findConfiguracao();
        }
    }
</script>
