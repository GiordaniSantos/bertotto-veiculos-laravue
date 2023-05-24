<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <!-- Card de listagem -->
                <card-component titulo="Criar Marca">
                    <template v-slot:conteudo>
                        <div class="row">
                            <div class="col-12 form-group">
                                <input-container-component titulo="Nome" id="novoNome" idHelp="novoNomeHelp" texto-ajuda="Informe o nome do marca">
                                    <input type="text" class="form-control" id="novoNome" aria-describedby="novoNomeHelp" placeholder="Nome do Marca" v-model="nome">
                                </input-container-component>
                            </div>
                        </div>
                    </template>
                    <template v-slot:rodape>
                        <a href="/admin/marcas" class="btn btn-primary btn-sm">Listar</a>
                        <button type="submit" class="btn btn-success btn-sm" style="float: right;" @click="salvar()">Criar</button>
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
                urlBase: '',
                nome: '',
            }
        }, 
        methods: {
            salvar(){
                let formData = new FormData();
                formData.append('nome', this.nome);

                let config = {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    }
                }
                
                axios.post(this.urlBase, formData, config)
                    .then(response => {
                        this.$swal("Sucesso", "Registro cadastrado com sucesso!", "success");
                    })  
                    .catch(errors => {
                        console.log(errors)
                        this.$swal("Oops...", "Algum erro aconteceu! " +errors.response.data.message, "error");
                    })
            }
        },
        mounted(){
            this.urlBase = import.meta.env.VITE_API_URL + "/marca";
        }
    }
</script>
