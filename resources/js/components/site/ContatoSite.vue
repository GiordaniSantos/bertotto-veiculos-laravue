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
                        
                                <form action="#" method="post">
                                        
                                    <span>
                                        <input type="text" class="input" id="nome" name="nome" placeholder="Nome" autocomplete="off" required=""/>
                                        <label for="nome"> <i class="fa-solid fa-user"></i> </label>
                                    </span>
                        
                                    <span>
                                        <input type="text" class="input" id="email" name="email" placeholder="E-mail" autocomplete="off" required=""/>
                                        <label for="email"> <i class="fa-solid fa-envelope"></i> </label>
                                    </span>
                        
                                    <span>
                                        <input type="text" class="input" id="assunto" name="assunto" placeholder="Assunto" autocomplete="off" required=""/>
                                        <label for="assunto"> <i class="fa-solid fa-phone"></i> </label>
                                    </span>
                        
                                    <span>
                                        <textarea type="text" class="textarea" id="mensagem" name="mensagem" rows="3" placeholder="Mensagem" autocomplete="off" required=""></textarea>
                                        <label for="mensagem"> <i class="fa-solid fa-comment"></i> </label>
                                    </span>
                        
                                    <div class="box-pulse">
                                        <button type="submit" class="botao-pulse"><i class="fa-solid fa-share"></i> Enviar</button>
                                    </div>
                        
                                </form>
                        
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
            }
        },
        methods: {

        },
        mounted() {
            this.urlBase = import.meta.env.VITE_API_URL_SITE;
            document.title = "Contato";
        },
    }
</script>
