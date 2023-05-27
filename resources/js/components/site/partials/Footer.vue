<template>
   <footer>
        <div class="row container-fluid borda-top">
            <div class="col-12 col-sm-4 col-lg-4 col-xl-4 endereco-footer-responsivo paddingFooterL">
                <h5 style="margin-bottom: 35px;">Endereço</h5>
                <ul class="list-inline">
                    <li class="cor-texto-endereco">Av. Coronel Theodomiro Porto da Fonseca, 2009</li>
                    <li class="cor-texto-endereco">Capão da Cruz</li>
                    <li class="cor-texto-endereco">Sapucaia do Sul - RS, 93230-440</li>
                </ul>
            </div>
            <div class="col-12 col-sm-4 col-lg-4 col-xl-4 contatos-footer-responsivo paddingFooterL">
                <h5 style="margin-bottom: 23px;">Contatos</h5>
                <dl class="list-contatos" style="margin-bottom: 0;">
                    <dt class="cor-texto-endereco" style="margin-right: 7px;">Telefone:</dt>
                    <dd><a href="" class="link-contato">51 9800-7554</a></dd>
                </dl>
                <dl class="list-contatos">
                    <dt class="cor-texto-endereco" style="margin-right: 7px;">Email:</dt>
                    <dd><a href="" class="link-contato">bertotto.veic@gmail.com</a></dd>
                </dl>
                <ul class="list-inline list-contatos">
                    <li><a href="" ><img :src="urlBaseImg+'/images/facebook.png'" class="img-midia-footer efeito-midia" alt="Facebook" style="width: 34px;"></a></li>
                    <li><a href=""><img :src="urlBaseImg+'/images/instagram.png'" class="img-midia-footer efeito-midia" alt="Instagram" style="width: 34px;"></a></li>
                </ul>
            </div>
            <div class="col-12 col-sm-4 col-lg-4 col-xl-4 img-logo-footer-responsivo paddingFooterL">
                <img :src="urlBaseImg+'/images/logo2.png'" class="img-logo-footer" alt="Bertotto Veículos" style="height: 188px;">
            </div>
        </div>
        <div>
            <div class="footer-2 rodape-resp">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-6">
                        <p class="float-start">&copy; {{ appName }} {{ dataAtual }} </p>
                        </div>
                        <div class="col-6">
                        <p class="float-end">Desenvolvido por <a href="https://www.linkedin.com/in/giordani-da-silveira-dos-santos-1b8168182/" class="link-contato" target="_blank">Giordani</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</template>

<script>
export default{
        data(){
            return {
                urlBaseImg: '',
                appName: '',
                dataAtual: '',
            }
        },
        methods: {
            togglePopup(){

                if (document.getElementById('menu').style.display == 'block') {
                    document.getElementById('menu').style.display = 'none';
                }else {
                    document.getElementById('menu').style.display = 'block';
                }
            },
        },
        mounted() {
            const data = new Date();
            this.dataAtual = data.getFullYear();
            this.urlBaseImg = import.meta.env.VITE_URL_BASE_IMG;
            this.appName = import.meta.env.VITE_APP_NAME;
        },
    }
</script>
