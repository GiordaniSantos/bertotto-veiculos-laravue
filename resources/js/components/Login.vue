<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Login</div>

                    <div class="card-body">
                        <div class="text-center" style="margin-bottom: 20px;">
                            <img :src="urlBaseImg+'/images/brasao.png'" width="100%" alt="Indisponível" title="Indisponível" style="width: 80px;">
                        </div>
                        <form method="POST" action="" @submit.prevent="login($event)">
                            <input type="hidden" name="_token" :value="csrf_token">
                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="" required autocomplete="email" autofocus v-model="email">

                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">Senha</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password" v-model="password">

                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember">

                                        <label class="form-check-label" for="remember">
                                            Mantenha-me Conectado
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Login
                                    </button>

                                    <a class="btn btn-link" href="">
                                        Esqueci a Senha
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default{
        props: ['csrf_token'],
        data(){
            return {
                email: '',
                password: '',
                urlBaseImg: '',
                urlBase: ''
            }
        },
        methods:  {
            login(e) {

                let configuracao = {
                    method: 'post',
                    body: new URLSearchParams({
                        'email': this.email,
                        'password': this.password
                    })
                };

                fetch(this.urlBase, configuracao)
                    .then(response => response.json())
                    .then(data => {
                        if(data.erro){
                            this.$swal("Oops...", "Algum erro aconteceu! " +data.erro, "error");
                        }else{

                            if(data.token){
                                document.cookie = 'token='+data.token+';SameSite=Lax'
                            }
                            //dar sequencia no envio do form de autenticacao
                            e.target.submit()
                            this.$swal("Sucesso", "Login efetuado com sucesso!", "success");
                        }
                    });
                
            }
        },
        mounted() {
            this.urlBase = import.meta.env.VITE_URL_BASE_IMG + "/api/login";
            this.urlBaseImg = import.meta.env.VITE_URL_BASE_IMG;
        }
    }
</script>
