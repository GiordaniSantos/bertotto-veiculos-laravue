<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">

                <!-- Card de listagem -->
                <card-component titulo="Criar Banner">
                    <template v-slot:conteudo>
                        <div class="row">
                            <div class="col-6 form-group">
                                <input-container-component titulo="Nome" id="novoNome" idHelp="novoNomeHelp">
                                    <input type="text" class="form-control" id="novoNome" aria-describedby="novoNomeHelp" placeholder="Nome" v-model="nome">
                                </input-container-component>
                      
                            </div>
                            <div class="col-6 form-group">
                                <input-container-component titulo="Ano / Modelo" id="nomeModelo" idHelp="nomeModeloHelp">
                                    <input type="text" class="form-control" id="nomeModelo" aria-describedby="nomeModeloHelp" placeholder="Ano / Modelo" v-model="ano_modelo">
                                </input-container-component>
                      
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-6 form-group">
                                <input-container-component titulo="Preço" id="preco" idHelp="precoHelp">
                                    <input type="text" class="form-control" id="preco" aria-describedby="precoHelp" placeholder="Preço" v-model="preco">
                                </input-container-component>
                      
                            </div>
                            <div class="col-3 form-group">
                                <input-container-component titulo="Portas" id="portas" idHelp="portasHelp">
                                    <input type="text" class="form-control" id="portas" aria-describedby="portasHelp" placeholder="Portas" v-model="portas">
                                </input-container-component>
                      
                            </div>
                            <div class="col-3 form-group">
                                <input-container-component titulo="Quilometragem" id="km" idHelp="kmHelp">
                                    <input type="text" class="form-control" id="km" aria-describedby="kmHelp" placeholder="Quilometragem" v-model="km">
                                </input-container-component>
                      
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-6 form-group">
                                <input-container-component titulo="Cor" id="cor" idHelp="corHelp">
                                    <input type="text" class="form-control" id="cor" aria-describedby="corHelp" placeholder="Cor" v-model="cor">
                                </input-container-component>
                      
                            </div>
                            <div class="col-6 form-group">
                                <input-container-component titulo="Câmbio" id="cambio" idHelp="cambioHelp">
                                    <select name="cambio" id="cambio" class="form-control" v-model="cambio">
                                        <option> Selecione </option>
                                        <option value="1"> Câmbio Manual </option>
                                        <option value="2"> Câmbio Automático </option>
                                        <option value="3"> Câmbio Automático CVT </option>
                                    </select>
                                </input-container-component>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-12">
                                <input-container-component titulo="Descrição" id="descricao" idHelp="descricaoHelp">
                                    <textarea name="descricao" class="form-control" placeholder="descricao" id="descricao" aria-describedby="descricaoHelp" style="width: 100% !important;" rows="4" cols="50" v-model="descricao"></textarea>
                                </input-container-component>
                                {{ mensagem }}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-12 form-group">
                                <label for="image" class="custom-file-label" data-browse="Enviar Imagens"></label>
                                <input-container-component id="imagem" id-help="imagemHelp">
                                    <input type="file" class="form-control-file" id="imagem" aria-describedby="imagemHelp" placeholder="Selecione uma imagem" @change="carregarImagem($event)" multiple>
                                </input-container-component>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div id="lista-images"></div>
                            </div>
                        </div>
                        <br>
                        <legend>Opcionais</legend>
                        <div class="row">
                            <div class="col-2">
                                <input-container-component titulo="Flex" id="tipoCombustivel" idHelp="tipoCombustivelHelp" >
                                    <input type="checkbox" id="tipoCombustivel" name="tipoCombustivel" aria-describedby="tipoCombustivelHelp" v-model="tipo_combustivel">
                                </input-container-component>
                            </div>
                            <div class="col-2">
                                <input-container-component titulo="Aceita Troca" id="aceitaTroca" idHelp="aceitaTrocaHelp" >
                                    <input type="checkbox" id="aceitaTroca" name="aceitaTroca" aria-describedby="aceitaTrocaHelp" v-model="aceita_troca">
                                </input-container-component>
                            </div>
                            <div class="col-2">
                                <input-container-component titulo="IPVA Pago" id="ipvaPago" idHelp="ipvaPagoHelp" >
                                    <input type="checkbox" id="ipvaPago" name="ipvaPago" aria-describedby="ipvaPagoHelp" v-model="ipva_pago">
                                </input-container-component>
                            </div>
                            <div class="col-2">
                                <input-container-component titulo="Licenciado" id="licenciado" idHelp="licenciadoHelp" >
                                    <input type="checkbox" id="licenciado" name="licenciado" aria-describedby="licenciadoHelp" v-model="licenciado">
                                </input-container-component>
                            </div>
                            <div class="col-2">
                                <input-container-component titulo="Air Bag" id="airBag" idHelp="airBagHelp" >
                                    <input type="checkbox" id="airBag" name="airBag" aria-describedby="airBagHelp" v-model="air_bag">
                                </input-container-component>
                            </div>
                            <div class="col-2">
                                <input-container-component titulo="Air Bag Duplo" id="airBagDuplo" idHelp="airBagDuploHelp" >
                                    <input type="checkbox" id="airBagDuplo" name="airBagDuplo" aria-describedby="airBagDuploHelp" v-model="air_bag_duplo">
                                </input-container-component>
                            </div>
                            <div class="col-2">
                                <input-container-component titulo="Alarme" id="alarme" idHelp="alarmeHelp" >
                                    <input type="checkbox" id="alarme" name="alarme" aria-describedby="alarmeHelp" v-model="alarme">
                                </input-container-component>
                            </div>
                            <div class="col-2">
                                <input-container-component titulo="Ar Condicionado Digital" id="arCondicionadoDigital" idHelp="arCondicionadoDigitalHelp" >
                                    <input type="checkbox" id="arCondicionadoDigital" name="arCondicionadoDigital" aria-describedby="arCondicionadoDigitalHelp" v-model="ar_condicionado_digital">
                                </input-container-component>
                            </div>
                            <div class="col-2">
                                <input-container-component titulo="Banco Couro" id="bancoCouro" idHelp="bancoCouroHelp" >
                                    <input type="checkbox" id="bancoCouro" name="bancoCouro" aria-describedby="bancoCouroHelp" v-model="banco_couro">
                                </input-container-component>
                            </div>
                            <div class="col-2">
                                <input-container-component titulo="Banco Regulagem Altura" id="bancoRegulagemAltura" idHelp="bancoRegulagemAlturaHelp" >
                                    <input type="checkbox" id="bancoRegulagemAltura" name="bancoRegulagemAltura" aria-describedby="bancoRegulagemAlturaHelp" v-model="banco_regulagem_altura">
                                </input-container-component>
                            </div>
                            <div class="col-2">
                                <input-container-component titulo="Chave Reserva" id="chaveReserva" idHelp="chaveReservaHelp" >
                                    <input type="checkbox" id="chaveReserva" name="chaveReserva" aria-describedby="chaveReservaHelp" v-model="chave_reserva">
                                </input-container-component>
                            </div>
                            <div class="col-2">
                                <input-container-component titulo="Computador Bordo" id="computadorBordo" idHelp="computadorBordoHelp" >
                                    <input type="checkbox" id="computadorBordo" name="computadorBordo" aria-describedby="computadorBordoHelp" v-model="computador_bordo">
                                </input-container-component>
                            </div>
                            <div class="col-2">
                                <input-container-component titulo="Desembaçador Traseiro" id="desembacadorTraseiro" idHelp="desembacadorTraseiroHelp" >
                                    <input type="checkbox" id="desembacadorTraseiro" name="desembacadorTraseiro" aria-describedby="desembacadorTraseiroHelp" v-model="desembacador_traseiro">
                                </input-container-component>
                            </div>
                            <div class="col-2">
                                <input-container-component titulo="Direção Elétrica" id="direcaoEletrica" idHelp="direcaoEletricaHelp" >
                                    <input type="checkbox" id="direcaoEletrica" name="direcaoEletrica" aria-describedby="direcaoEletricaHelp" v-model="direcao_eletrica">
                                </input-container-component>
                            </div>
                            <div class="col-2">
                                <input-container-component titulo="Direção Escamoteável" id="direcaoEscamoteavel" idHelp="direcaoEscamoteavelHelp" >
                                    <input type="checkbox" id="direcaoEscamoteavel" name="direcaoEscamoteavel" aria-describedby="direcaoEscamoteavelHelp" v-model="direcao_escamoteavel">
                                </input-container-component>
                            </div>
                            <div class="col-2">
                                <input-container-component titulo="Direção Multifuncional" id="direcaoMultifuncional" idHelp="direcaoMultifuncionalHelp" >
                                    <input type="checkbox" id="direcaoMultifuncional" name="direcaoMultifuncional" aria-describedby="direcaoMultifuncionalHelp" v-model="direcao_multifuncional">
                                </input-container-component>
                            </div>
                            <div class="col-2">
                                <input-container-component titulo="Faróis Auxiliares" id="faroisAuxiliares" idHelp="faroisAuxiliaresHelp" >
                                    <input type="checkbox" id="faroisAuxiliares" name="faroisAuxiliares" aria-describedby="faroisAuxiliaresHelp" v-model="farois_auxiliares">
                                </input-container-component>
                            </div>
                            <div class="col-2">
                                <input-container-component titulo="Faróis Led" id="faroisLed" idHelp="faroisLedHelp" >
                                    <input type="checkbox" id="faroisLed" name="faroisLed" aria-describedby="alarmeHelp" v-model="farois_led">
                                </input-container-component>
                            </div>
                            <div class="col-2">
                                <input-container-component titulo="Freios ABS" id="freiosAbs" idHelp="freiosAbsHelp" >
                                    <input type="checkbox" id="freiosAbs" name="freiosAbs" aria-describedby="alarmeHelp" v-model="freios_abs">
                                </input-container-component>
                            </div>
                            <div class="col-2">
                                <input-container-component titulo="Interface" id="interface" idHelp="interfaceHelp" >
                                    <input type="checkbox" id="interface" name="interface" aria-describedby="interfaceHelp" v-model="interfaces">
                                </input-container-component>
                            </div>
                            <div class="col-2">
                                <input-container-component titulo="Limpador Traseiro" id="limpadorTraseiro" idHelp="limpadorTraseiroHelp" >
                                    <input type="checkbox" id="limpadorTraseiro" name="limpadorTraseiro" aria-describedby="limpadorTraseiroHelp" v-model="limpador_traseiro">
                                </input-container-component>
                            </div>
                            <div class="col-2">
                                <input-container-component titulo="Manual do Proprietário" id="manualProprietario" idHelp="manualProprietarioHelp" >
                                    <input type="checkbox" id="manualProprietario" name="manualProprietario" aria-describedby="manualProprietarioHelp" v-model="manual_proprietario">
                                </input-container-component>
                            </div>
                            <div class="col-2">
                                <input-container-component titulo="Porta Malas Elétrico" id="portaMalasEletrico" idHelp="portaMalasEletricoHelp" >
                                    <input type="checkbox" id="portaMalasEletrico" name="portaMalasEletrico" aria-describedby="portaMalasEletricoHelp" v-model="porta_malas_eletrico">
                                </input-container-component>
                            </div>
                            <div class="col-2">
                                <input-container-component titulo="Retrovisor Elétrico" id="retrovisoEletrico" idHelp="retrovisoEletricoHelp" >
                                    <input type="checkbox" id="retrovisoEletrico" name="retrovisoEletrico" aria-describedby="retrovisoEletricoHelp" v-model="retrovisor_eletrico">
                                </input-container-component>
                            </div>
                            <div class="col-2">
                                <input-container-component titulo="Roda de Liga Leve" id="ligaleve" idHelp="ligaleveHelp" >
                                    <input type="checkbox" id="ligaleve" name="ligaleve" aria-describedby="ligaleveHelp" v-model="liga_leve">
                                </input-container-component>
                            </div>
                            <div class="col-2">
                                <input-container-component titulo="Sensor de Chuva" id="sensorChuva" idHelp="sensorChuvaHelp" >
                                    <input type="checkbox" id="sensorChuva" name="sensorChuva" aria-describedby="sensorChuvaHelp" v-model="sensor_chuva">
                                </input-container-component>
                            </div>
                            <div class="col-2">
                                <input-container-component titulo="Sensor de Estacionamento" id="sensorEstacionamento" idHelp="sensorEstacionamentoHelp" >
                                    <input type="checkbox" id="sensorEstacionamento" name="sensorEstacionamento" aria-describedby="sensorEstacionamentoHelp" v-model="sensor_estacionamento">
                                </input-container-component>
                            </div>
                            <div class="col-2">
                                <input-container-component titulo="Som no Volante" id="somVolante" idHelp="somVolanteHelp" >
                                    <input type="checkbox" id="somVolante" name="somVolante" aria-describedby="somVolanteHelp" v-model="som_volante">
                                </input-container-component>
                            </div>
                            <div class="col-2">
                                <input-container-component titulo="Som Original" id="somOriginal" idHelp="somOriginalHelp" >
                                    <input type="checkbox" id="somOriginal" name="somOriginal" aria-describedby="somOriginalHelp" v-model="som_original">
                                </input-container-component>
                            </div>
                            <div class="col-2">
                                <input-container-component titulo="Teto Panorâmico" id="tetoPanoramico" idHelp="tetoPanoramicoHelp" >
                                    <input type="checkbox" id="tetoPanoramico" name="tetoPanoramico" aria-describedby="somVolanteHelp" v-model="teto_panoramico">
                                </input-container-component>
                            </div>
                            <div class="col-2">
                                <input-container-component titulo="Teto Solar" id="tetoSolar" idHelp="tetoSolarHelp" >
                                    <input type="checkbox" id="tetoSolar" name="tetoSolar" aria-describedby="tetoSolarHelp" v-model="teto_solar">
                                </input-container-component>
                            </div>
                            <div class="col-2">
                                <input-container-component titulo="Travas Elétricas" id="travasEletricas" idHelp="travasEletricasHelp" >
                                    <input type="checkbox" id="travasEletricas" name="travasEletricas" aria-describedby="travasEletricasHelp" v-model="travas_eletricas">
                                </input-container-component>
                            </div>
                            <div class="col-2">
                                <input-container-component titulo="Vidros Elétricos" id="vidrosEletricos" idHelp="vidrosEletricosHelp" >
                                    <input type="checkbox" id="vidrosEletricos" name="vidrosEletricos" aria-describedby="vidrosEletricosHelp" v-model="vidros_eletricos">
                                </input-container-component>
                            </div>
                        </div>
                        <br><br>
                        <div class="row">
                            <div class="col-2">
                                <input-container-component titulo="Ativo" id="ativo" idHelp="ativoHelp" >
                                    <input type="checkbox" id="ativo" name="ativo" aria-describedby="ativoHelp" v-model="ativo">
                                </input-container-component>
                            </div>
                            <div class="col-2">
                                <input-container-component titulo="Destaque" id="destaque" idHelp="destaqueHelp" >
                                    <input type="checkbox" id="destaque" name="destaque" aria-describedby="destaqueHelp" v-model="destaque">
                                </input-container-component>
                            </div>
                            <div class="col-2">
                                <input-container-component titulo="Recomendado" id="recomendado" idHelp="recomendadoHelp" >
                                    <input type="checkbox" id="recomendado" name="recomendado" aria-describedby="recomendadoHelp" v-model="recomendado">
                                </input-container-component>
                            </div>
                        </div>
                    </template>
                    <template v-slot:rodape>
                        <a href="/admin/veiculos" class="btn btn-primary btn-sm">Listar</a>
                        <button type="submit" class="btn btn-primary btn-sm" style="float: right;" @click="salvar()">Criar</button>
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
                urlBase: 'http://localhost:8000/api/v1/banner',
                titulo: '',
                link: '',
                arquivoImagem: [],
                ativo: '',
                nova_guia: '',
                ordem: ''
            }
        },
        computed: {
            token(){
                //pegando o token JWT do cookie
                let token = document.cookie.split(';').find(indice => {
                    return indice.includes('token=');
                });

                token = token.split('=')[1];
                token = 'Bearer ' + token;

                return token;
            }
        },  
        methods: {
            salvar(){
                let formData = new FormData();
                formData.append('titulo', this.titulo);
                formData.append('link', this.link);
                formData.append('arquivo', this.arquivoImagem[0])
                formData.append('ativo', this.ativo ? 1 : 0);
                formData.append('nova_guia', this.nova_guia ? 1 : 0);
                formData.append('ordem', this.ordem);

                let config = {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        'Accept': 'application/json',
                        'Authorization': this.token
                    }
                }

                axios.post(this.urlBase, formData, config)
                    .then(response => {
                        console.log(response)
                        this.$swal("Sucesso", "Registro cadastrado com sucesso!", "success");
                    })  
                    .catch(errors => {
                        console.log(errors)
                        this.$swal("Oops...", "Algum erro aconteceu! " +errors.response.data.message, "error");
                    })
            },
            carregarImagem(e) {
                this.arquivoImagem = e.target.files
            },
        }
    }
</script>
