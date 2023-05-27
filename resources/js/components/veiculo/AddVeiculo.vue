<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">

                <!-- Card de listagem -->
                <card-component titulo="Criar Veículo">
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
                            <div class="col-6 form-group">
                                <input-container-component titulo="Tipo Combustível" id="tipoCombustivel" idHelp="tipoCombustivelHelp">
                                    <select name="tipoCombustivel" id="tipoCombustivel" class="form-control" v-model="tipo_combustivel">
                                        <option> Selecione </option>
                                        <option value="4"> Flex </option>
                                        <option value="5"> Diesel </option>
                                        <option value="6"> Gasolina </option>
                                        <option value="7"> GNV e Flex </option>
                                        <option value="8"> GNV e Gasolina </option>
                                        <option value="10"> GNV e Álcool </option>
                                        <option value="9"> Álcool </option>
                                        <option value="10"> GNV e Álcool </option>
                                        <option value="11"> Elétrico </option>
                                    </select>
                                </input-container-component>
                            </div>
                            <div class="col-3 form-group">
                                <input-container-component titulo="Marca" id="marca" idHelp="marcaHelp">
                                    <select name="marca" id="marca" class="form-control" v-model="marca">
                                        <option> Selecione </option>
                                        <option :value="marca.id" v-for="marca in marcas" :key="marca.id"> {{marca.nome}} </option>
                                    </select>
                                </input-container-component>
                            </div>
                            <div class="col-3 form-group">
                                <input-container-component titulo="Data de Publicação" id="data" idHelp="dataHelp">
                                    <input type="datetime-local" class="form-control" id="data" name="data_publicacao" v-model="data_publicacao">
                                </input-container-component>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-12">
                                <input-container-component titulo="Descrição" id="descricao" idHelp="descricaoHelp">
                                    <textarea name="descricao" class="form-control" placeholder="descricao" id="descricao" aria-describedby="descricaoHelp" style="width: 100% !important;" rows="4" cols="50" v-model="descricao"></textarea>
                                </input-container-component>
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
                            <div class="col-2">
                                <input-container-component titulo="Ordem" id="ordem" idHelp="ordemHelp" >
                                    <input type="number" id="ordem" name="ordem" aria-describedby="ordemHelp" v-model="ordem">
                                </input-container-component>
                            </div>
                        </div>
                        <br><br>
                        <legend>Opcionais</legend>
                        <div class="row">
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
                    </template>
                    <template v-slot:rodape>
                        <a href="/admin/veiculos" class="btn btn-primary btn-sm">Listar</a>
                        <button type="submit" class="btn btn-success btn-sm" style="float: right;" @click="salvar()">Criar</button>
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
                urlBase: '',
                urlMarcas: '',
                nome: '',
                ordem: '',
                ano_modelo: '',
                preco: '',
                portas: '',
                km: '',
                cor: '',
                cambio: '',
                marca: '',
                descricao: '',
                data_publicacao: '',
                marcas: {},
                arquivoImagem: [],
                tipo_combustivel: '',
                aceita_troca: false,
                ipva_pago: false,
                licenciado: false,
                air_bag: false,
                air_bag_duplo: false,
                alarme: false,
                ar_condicionado_digital: false,
                banco_couro: false,
                banco_regulagem_altura: false,
                chave_reserva: false,
                computador_bordo: false,
                desembacador_traseiro: false,
                direcao_eletrica: false,
                direcao_escamoteavel: false,
                direcao_multifuncional: false,
                farois_auxiliares: false,
                farois_led: false,
                freios_abs: false,
                interfaces: false,
                limpador_traseiro: false,
                manual_proprietario: false,
                porta_malas_eletrico: false,
                retrovisor_eletrico: false,
                liga_leve: false,
                sensor_chuva: false,
                sensor_estacionamento: false,
                som_volante: false,
                som_original: false,
                teto_panoramico: false,
                teto_solar: false,
                travas_eletricas: false,
                vidros_eletricos: false,
                ativo: false,
                destaque: false,
                recomendado: false,
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
            carregarMarcas(){

                this.$swal.showLoading();

                axios.get(this.urlMarcas)
                    .then(response => {
                        this.marcas  = response.data;
                        this.$swal.close();
                        console.log(this.marcas);
                    })
                    .catch(errors => {
                        this.$swal("Oops...", "Algum erro aconteceu! " +errors.response.data.message, "error");
                    });
            },
            salvar(){
                let formData = new FormData();
                formData.append('nome', this.nome);
                formData.append('ano_modelo', this.ano_modelo);
                formData.append('preco', this.preco);
                formData.append('portas', this.portas);
                formData.append('km', this.km);
                formData.append('cor', this.cor);
                formData.append('cambio', this.cambio);
                formData.append('marca_id', this.marca);
                formData.append('data_publicacao', this.data_publicacao);
                formData.append('tipo_combustivel', this.tipo_combustivel ? this.tipo_combustivel : '');
                formData.append('ordem', this.ordem ? this.ordem : '');
                formData.append('descricao', this.descricao);
                for(let i = 0; i < this.arquivoImagem.length; i++){
                    formData.append('images[]', this.arquivoImagem[i])
                }
                formData.append('ativo', this.ativo == true ? 1 : 0);
                formData.append('destaque', this.destaque == true ? 1 : 0);
                formData.append('recomendado', this.recomendado == true ? 1 : 0);
                formData.append('aceita_troca', this.aceita_troca == true ? 1 : 0);
                formData.append('ipva_pago', this.ipva_pago == true ? 1 : 0);
                formData.append('licenciado', this.licenciado == true ? 1 : 0);
                formData.append('air_bag', this.air_bag == true ? 1 : 0);
                formData.append('air_bag_duplo', this.air_bag_duplo == true ? 1 : 0);
                formData.append('alarme', this.alarme == true ? 1 : 0);
                formData.append('ar_condicionado_digital', this.ar_condicionado_digital == true ? 1 : 0);
                formData.append('banco_couro', this.banco_couro == true ? 1 : 0);
                formData.append('banco_regulavel_altura', this.banco_regulagem_altura == true ? 1 : 0);
                formData.append('chave_reserva', this.chave_reserva == true ? 1 : 0);
                formData.append('computador_bordo', this.computador_bordo == true ? 1 : 0);
                formData.append('desembacador_traseiro', this.desembacador_traseiro == true ? 1 : 0);
                formData.append('direcao_eletrica', this.direcao_eletrica == true ? 1 : 0);
                formData.append('direcao_escamoteavel', this.direcao_escamoteavel == true ? 1 : 0);
                formData.append('direcao_multifuncional', this.direcao_multifuncional == true ? 1 : 0);
                formData.append('farois_auxiliares', this.farois_auxiliares == true ? 1 : 0);
                formData.append('farois_led', this.farois_led == true ? 1 : 0);
                formData.append('freios_abs', this.freios_abs == true ? 1 : 0);
                formData.append('interface', this.interfaces == true ? 1 : 0);
                formData.append('limpador_traseiro', this.limpador_traseiro == true ? 1 : 0);
                formData.append('manual_proprietario', this.manual_proprietario == true ? 1 : 0);
                formData.append('porta_malas_eletrico', this.porta_malas_eletrico == true ? 1 : 0);
                formData.append('retrovisor_eletrico', this.retrovisor_eletrico == true ? 1 : 0);
                formData.append('liga_leve', this.liga_leve == true ? 1 : 0);
                formData.append('sensor_chuva', this.sensor_chuva == true ? 1 : 0);
                formData.append('sensor_estacionamento', this.sensor_estacionamento == true ? 1 : 0);
                formData.append('som_volante', this.som_volante == true ? 1 : 0);
                formData.append('som_original', this.som_original == true ? 1 : 0);
                formData.append('teto_panoramico', this.teto_panoramico == true ? 1 : 0);
                formData.append('teto_solar', this.teto_solar == true ? 1 : 0);
                formData.append('travas_eletricas', this.travas_eletricas == true ? 1 : 0);
                formData.append('vidros_eletricos', this.vidros_eletricos == true ? 1 : 0);

                let config = {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        'Accept': 'application/json',
                        'Authorization': this.token
                    }
                }

                axios.post(this.urlBase, formData, config)
                    .then(response => {
                        document.getElementById("imagem").value = '';
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
        },
        mounted() {
            this.urlBase = import.meta.env.VITE_API_URL + "/veiculo";
            this.urlMarcas = import.meta.env.VITE_API_URL + "/marca";
            this.carregarMarcas();
        }
    }
</script>
