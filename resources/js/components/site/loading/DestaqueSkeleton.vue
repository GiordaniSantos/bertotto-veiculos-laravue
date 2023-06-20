<template>
    <div class="container-fluid" v-if="loading">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-6" style="padding: 0;">
                <div class="img-veiculo-capa text-center">
                    <img src="" class="skeleton" width="100%" style="width: 100%; background: rgb(221, 219, 221);" >
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-6 margin-top-responsiva paddingResponsivo padding80">
                <div class="row">
                    <div class="col-12">
                        <h2 class="titulo skeleton" style="width: 321px; height: 25px; border-radius: 5px; background: rgb(221, 219, 221);"><span class="square"></span></h2>
                    </div>
                    <div class="col-12 text-left">
                        <p class="texto-black skeleton" style=" height: 240px; border-radius: 5px; margin-top:15px; background: rgb(221, 219, 221);"></p>
                        <br />
                        <a class="btn-padrao skeleton" style="background: rgb(221, 219, 221);"></a>
                    </div>
                </div>   
            </div>
        </div>  
    </div>
    <div class="container-fluid" v-if="loading">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-6 margin-top-responsiva paddingResponsivo padding80 d2">
                <div class="row">
                    <div class="col-12">
                        <h2 class="titulo titulo-white skeleton" style="width: 321px; height: 25px; border-radius: 5px; background: rgb(221, 219, 221);"><span class="square"></span></h2>
                    </div>
                    <div class="col-12 text-right">
                        <p class="texto-white skeleton" style=" height: 240px; border-radius: 5px; margin-top:15px; background: rgb(221, 219, 221);"></p>
                        <br />
                        <a style="background: rgb(221, 219, 221);" class="btn-padrao btn-cor-branco skeleton"></a>
                    </div>
                </div>   
            </div>
            <div class="col-12 col-md-12 col-lg-6 d1" style="padding: 0;">
                <div class="img-veiculo-capa text-center">
                    <img src="" class="skeleton" width="100%" style="width: 100%; background: rgb(221, 219, 221);" >
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid" v-if="loading">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-6" style="padding: 0;">
                <div class="img-veiculo-capa text-center">
                    <img src="" class="skeleton" width="100%" style="width: 100%; background: rgb(221, 219, 221);" >
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-6 margin-top-responsiva paddingResponsivo padding80">
                <div class="row">
                    <div class="col-12">
                        <h2 class="titulo skeleton" style="width: 321px; height: 25px; border-radius: 5px; background: rgb(221, 219, 221);"><span class="square"></span></h2>
                    </div>
                    <div class="col-12 text-left">
                        <p class="texto-black skeleton" style=" height: 240px; border-radius: 5px; margin-top:15px; background: rgb(221, 219, 221);"></p>
                        <br />
                        <a class="btn-padrao skeleton" style="background: rgb(221, 219, 221);"></a>
                    </div>
                </div>   
            </div>
        </div>  
    </div>
</template>

<script>
export default{
        props: {
            loading: Boolean
        }
    }
</script>
