<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <!-- Card de listagem -->
                <card-component titulo="Visualizar Contato">
                    <template v-slot:conteudo>
                        <table class="table table-striped table-bordered">
                        <tr>
                            <td>ID:</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Nome:</td>
                            <td>{{ $store.state.item.nome }}</td>
                        </tr>
                        <tr>
                            <td>Status:</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>E-mail:</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Telefone:</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Mensagem:</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Ativo:</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Resposta:</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Data Resposta:</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Data Criação:</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Data Modificação:</td>
                            <td></td>
                        </tr>
                    </table>
                    </template>
                    <template v-slot:rodape>
                        <a href="/admin/contatos" class="btn btn-primary btn-sm">Listar</a>
                        <button type="submit" class="btn btn-primary btn-sm" style="float: right;" @click="salvar()">Editar</button>
                    </template>
                </card-component>
                <!-- fim da listagem -->
            </div>
        </div>
        
    </div>
</template>

<script>
    export default {}
</script>
