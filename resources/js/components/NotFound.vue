<template>
    <section>
        <br/><br><br>
        <h2 class="text-center">
            <strong>A rota {{ url }} não foi encontrada.</strong>
        </h2>
        <div class="container-fluid text-center">
            <hr/><br/>
            <span class="material-symbols-outlined">sentiment_dissatisfied</span>
            <p style="font-size:22px">
                OPS! Ocorreu algum problema.<br />
                Volte a navegar pelo site clicando no botão abaixo.
                <br /><br />
            </p>
            <div class="text-center"> 
                <a href="/" class="btn-padrao"><span class="material-symbols-outlined">home</span> Pagina Inicial</a>
            </div>
        </div>
    </section>
    <br><br><br><br>
  </template>

<script>
export default {
    data(){
        return {
            url: ''
        }
    }, 
    mounted() {
        document.title = "Not Found 404";
        this.url = this.$route.fullPath;
    },
}
</script>