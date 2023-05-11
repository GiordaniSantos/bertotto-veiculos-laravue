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
                                    <input type="email" class="form-control" id="inputEmail" aria-describedby="emailHelp" placeholder="Email do Contato">
                                </input-container-component>
                            </div>
                            <div class="col-6 form-group">
                                <input-container-component titulo="Nome do Contato" id="inputnome" idHelp="nomeHelp" texto-ajuda="Opcional. Informe o nome do contato">
                                    <input type="text" class="form-control" id="inputNome" aria-describedby="nomeHelp" placeholder="Nome do Contato">
                                </input-container-component>
                            </div>
                        </div>
                    </template>
                    <template v-slot:rodape>
                        <button type="submit" class="btn btn-primary btn-sm" style="float: right;">Pesquisar</button>
                    </template>
                </card-component>
                <!-- fim card de busca -->

                <!-- Card de listagem -->
                <card-component titulo="Contatos">
                    <template v-slot:conteudo>
                        <table-component></table-component>
                    </template>
                    <template v-slot:rodape>
                        <a href="/admin/contato/create" class="btn btn-primary btn-sm" style="float: right;">Adicionar</a>
                    </template>
                </card-component>
                <!-- fim da listagem -->
            </div>
        </div>
        
    </div>
</template>

<script>

</script>
