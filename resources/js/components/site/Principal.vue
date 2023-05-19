<template>
    <div class="site-index">
        <div class="body-content">
            <section v-if="banners">
                <div class="banner-capa">
                    <div class="banner-background" v-for="(banner,key) in banners" :key="key">
                        {{ banner.arquivo.arquivo }}
                    </div>
                </div>
            </section>
            
        </div>
        <br><br>
    </div>
    <section class="padding10 bg-dark">
    </section>
    <div class="row">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3460.8457791442443!2d-51.12890152351193!3d-29.83987302182192!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95196ff6686714df%3A0x2cc1eae54f3d005f!2sBertotto%20Ve%C3%ADculos!5e0!3m2!1spt-BR!2sbr!4v1683158378770!5m2!1spt-BR!2sbr" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</template>

<script>
export default{
        data(){
            return {
                urlBase: 'http://localhost:8000/api/v1/site',
                urlBaseImg: 'http://localhost:8000',
                veiculosDestaque: {},
                banners: {}
            }
        },
        methods: {
            formataDataTempo(d){
                if(!d) return ''

                d = d.split('T');

                let data = d[0];
                let tempo = d[1];

                data = data.split('-');

                //formatando a data
                data = data[2] + "/" + data[1] + "/" + data[0];

                //formatando o tempo
                tempo = tempo.split('.');
                tempo = tempo[0];

                return data + ' às ' + tempo;
            },
            carregarListaDestaque(){

                let url = this.urlBase + '/veiculos/destaque';
                
                let config = {
                    headers: {
                        'Accept': 'application/json',
                    }
                }

                this.$swal.showLoading();

                axios.get(url, config)
                    .then(response => {
                        this.veiculosDestaque  = response.data;
                        this.$swal.close();
                        console.log(this.veiculosDestaque);
                    })
                    .catch(errors => {
                        this.$swal("Oops...", "Algum erro aconteceu! " +errors.response.data.message, "error");
                    });
            },
            carregarBanners(){

            let url = this.urlBase + '/banner';

            let config = {
                headers: {
                    'Accept': 'application/json',
                }
            }

            this.$swal.showLoading();

            axios.get(url, config)
                .then(response => {
                    this.banners  = response.data;
                    this.$swal.close();
                    console.log(this.banners);
                })
                .catch(errors => {
                    this.$swal("Oops...", "Algum erro aconteceu! " +errors.response.data.message, "error");
                });
            },
        },
        mounted() {
            this.carregarBanners();
            this.carregarListaDestaque();
        }
    }
</script>

