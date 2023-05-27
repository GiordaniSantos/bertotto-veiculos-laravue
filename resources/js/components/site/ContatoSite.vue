<template>
    <br><br>
    <section class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-sm-12 col-xs-12 margin40T margin-bottom-responsiva">
                <div class="titulo">
                    Contato
                </div>
                <br>
                <p>
                Para entrar em contato conosco, envie um e-mail para bertotto.veic@gmail.com ou preencha o formulário abaixo.
                </p>
                <div class="row">
                    <div class="col-md-8 col-sm-12 col-xs-12">
                        <div class="box-formulario" style="padding: 0px 0px 15px 0px;">        
        
                            <div class="formulario">
                                        
                                <span>
                                    <input type="text" class="input" id="nome" name="nome" placeholder="Nome" autocomplete="off" required="" v-model="nome"/>
                                    <label for="nome"> <i class="fa-solid fa-user"></i> </label>
                                </span>
                    
                                <span>
                                    <input type="text" class="input" id="email" name="email" placeholder="E-mail" autocomplete="off" required="" v-model="email"/>
                                    <label for="email"> <i class="fa-solid fa-envelope"></i> </label>
                                </span>
                    
                                <span>
                                    <input type="text" class="input" id="telefone" name="telefone" placeholder="Telefone" autocomplete="off" required="" v-model="telefone"/>
                                    <label for="telefone"> <i class="fa-solid fa-phone"></i> </label>
                                </span>
                    
                                <span>
                                    <textarea type="text" class="textarea" id="mensagem" name="mensagem" rows="3" placeholder="Mensagem" autocomplete="off" required="" v-model="mensagem"></textarea>
                                    <label for="mensagem"> <i class="fa-solid fa-comment"></i> </label>
                                </span>
                    
                                <div class="box-pulse">
                                    <button type="submit" class="botao-pulse" @click="enviar()"><i class="fa-solid fa-share"></i> Enviar</button>
                                </div>
                        
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 margin40T">
                <div class="titulo">
                    Endereço
                </div>
                <br>
                <div class="row">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3460.8457791442443!2d-51.12890152351193!3d-29.83987302182192!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95196ff6686714df%3A0x2cc1eae54f3d005f!2sBertotto%20Ve%C3%ADculos!5e0!3m2!1spt-BR!2sbr!4v1683158378770!5m2!1spt-BR!2sbr" width="600" height="450" style="border: solid 1px #ffc107 !important;" frameborder="0" ></iframe>
                </div>
            </div>
        </div>
    </section>
    <br><br>  
</template>

<script>
    export default{
        data(){
            return {
                urlBase: '',
                nome: '',
                email: '',
                telefone: '',
                mensagem: ''
            }
        },
        methods: {
            enviar(){
                let url = this.urlBase + '/contato';
                let formData = new FormData();
                formData.append('nome', this.nome);
                formData.append('email', this.email);
                formData.append('telefone', this.telefone);
                formData.append('mensagem', this.mensagem);

                let config = {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    }
                }

                axios.post(url, formData, config)
                    .then(response => {
                        this.$swal("Sucesso", "Contato enviado com sucesso!", "success");
                    })  
                    .catch(errors => {
                        console.log(errors)
                        this.$swal("Oops...", "Algum erro aconteceu! " +errors.response.data.message, "error");
                    })
            }
        },
        mounted() {
            this.urlBase = import.meta.env.VITE_API_URL_SITE;
            document.title = "Contato";
        },
    }
</script>
