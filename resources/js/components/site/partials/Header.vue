<template>
    <div class="row bg-green midias-topo">
        <div class="col-12">
            <div class="text-right margin-midiasT">
                <br><br>
                    <a href="" target="_blank" class="midia-footer">
                        <img :src="urlBaseImg+'/images/facebook.png'" class="midia-topo" alt="Facebook" style="width: 24px;">
                    </a>
                    <a href="" target="blank" class="midia-footer">
                        <img :src="urlBaseImg+'/images/instagram.png'" class="midia-topo" alt="Instagram" style="width: 24px;">
                    </a>
                    <a href="" target="_blank" class="midia-footer">
                        <img :src="urlBaseImg+'/images/youtube.png'" class="midia-topo" alt="Youtube" style="width: 24px;">
                    </a>
                    <a href="" target="_blank" class="midia-footer">
                        <img :src="urlBaseImg+'/images/twitter.png'" class="midia-topo" alt="Twitter" style="width: 24px;">
                    </a>
                    <a href="" target="_blank" class="midia-footer">
                        <img :src="urlBaseImg+'/images/spotify.png'" class="midia-topo" alt="Spotify" style="width: 24px;">
                    </a>
                    <a href="" target="_blank" class="midia-footer">
                        <img :src="urlBaseImg+'/images/whatsapp.png'" class="midia-topo" alt="Whatsapp" style="width: 24px;">
                    </a>
            </div>
        </div>
    </div>
    <div id="logo" class="bg-fundo-dark">
        <div class="row margin-menu">
            <div id="logo-menu" class="col-10 col-md-10 col-lg-8 col-xl-4 nopadding">
                <div class="col-4">
                    <a href="/" title="IPSS">
                        <h1 class="nopadding nomargin"><img :src="urlBaseImg+'/images/logo.png'" alt="Bertotto Veículos"></h1>
                    </a>  
                </div>
            </div>
            <div id="posicao-menu" class="col-2 col-md-2 col-lg-4 col-xl-8">
                <menu-site-component></menu-site-component>
                <span data-menu-toggle="menu" class="menu-fechado" @click="togglePopup();"><i class="fa-solid fa-bars"></i> menu</span>
            </div>
        </div>
    </div>
</template>

<script>
export default{
        data(){
            return {
                urlBaseImg: '',
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
            this.urlBaseImg = import.meta.env.VITE_URL_BASE_IMG;
        },
    }
</script>
