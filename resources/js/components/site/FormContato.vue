<template>
    
    <div class="box-formulario">        
        
        <div class="formulario">
            
            <div class="title-form">
              <h1>Entre em Contato</h1>
            </div>
    
      
                     
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
    
    </div><!--Box Formulario-->  
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
        },
    }
</script>
