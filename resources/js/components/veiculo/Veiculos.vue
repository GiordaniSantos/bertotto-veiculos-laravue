<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">

                <!-- Card de Busca -->
                <card-component titulo="Buscar veiculos">
                    <template v-slot:conteudo>
                        <div class="row">
                            <div class="col-6 form-group">
                                <input-container-component titulo="Nome do Veículo" id="inputnome" idHelp="nomeHelp" texto-ajuda="Opcional. Informe o nome do veículo">
                                    <input type="text" class="form-control" id="inputNome" aria-describedby="nomeHelp" placeholder="Nome do Veículo" v-model="busca.nome">
                                </input-container-component>
                            </div>
                            <div class="col-6 form-group">
                                <input-container-component titulo="Ativo" id="inputAtivo" idHelp="AtivoHelp" texto-ajuda="Opcional. Informe se o Veículo é Ativo ou não">
                                    <select name="cambio"  id="inputAtivo" aria-describedby="AtivoHelp" class="form-control" v-model="busca.ativo">
                                        <option> Selecione </option>
                                        <option value="1"> Sim </option>
                                        <option value="0"> Não </option>
                                    </select>
                                </input-container-component>
                            </div>
                        </div>
                    </template>
                    <template v-slot:rodape>
                        <a href="/admin/veiculos" class="btn btn-primary btn-sm">Limpar</a>
                        <button type="submit" class="btn btn-primary btn-sm" style="float: right;" @click="pesquisar()">Pesquisar</button>
                    </template>
                </card-component>
                <!-- fim card de busca -->

                <!-- Card de listagem -->
                <card-component titulo="Veículos">
                    <template v-slot:conteudo>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Ativo</th>
                                    <th>Destaque</th>
                                    <th>Recomendado</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody v-if="veiculos.data.length > 0">
                                <tr v-for="(veiculo,key) in veiculos.data" :key="key">
                                    <td>{{ veiculo.nome }}</td>
                                    <td>{{ veiculo.ativo ? 'Sim' : 'Não' }} </td>
                                    <td>{{ veiculo.destaque ? 'Sim' : 'Não' }}</td>
                                    <td>{{ veiculo.recomendado ? 'Sim' : 'Não' }}</td>
                                    <td>
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#showModal" @click="findVeiculo(veiculo.id)"><i class="fa-solid fa-eye"></i></button>
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateModal" @click="findVeiculo(veiculo.id)"><i class="fa-solid fa-pen"></i></button>
                                        <button type="button" class="btn btn-danger" @click="deletar(veiculo.id)"><i class="fa-solid fa-trash"></i></button>
                                        
                                    </td>
                                </tr>
                            </tbody>
                            <tbody v-else>
                                <tr>
                                    <td colspan="4" align="center">Não há registros.</td>
                                </tr>
                            </tbody>
                        </table>
                    </template>
                    <template v-slot:rodape>
                        <div class="row">
                            <div class="col-10">
                                <paginate-component v-if="veiculos.data.length == 10">
                                    <li v-for="link, key in veiculos.links" :key="key" :class="link.active ? 'page-item active' : 'page-item'" @click="paginacao(link)">
                                        <a class="page-link" v-html="link.label"></a>
                                    </li>
                                </paginate-component>
                            </div>
                            <div class="col-2">
                                <a href="/admin/veiculo/create" class="btn btn-primary btn-sm" style="float: right;">Adicionar</a>
                            </div>
                        </div>
                    </template>
                </card-component>
                <!-- fim da listagem -->

                <!-- Modal Show -->
                <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="showModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="showModalLabel" v-if="veiculoBuscado.titulo">Visualizar: {{ veiculoBuscado.titulo }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-striped table-bordered">
                                <tr>
                                    <td>ID:</td>
                                    <td>{{ veiculoBuscado.id }}</td>
                                </tr>
                                <tr>
                                    <td>Nome:</td>
                                    <td>{{ veiculoBuscado.nome }}</td>
                                </tr>
                                <tr>
                                    <td>Marca:</td>
                                    <td>{{ veiculoBuscado.marca ? veiculoBuscado.marca.nome : '' }}</td>
                                </tr>
                                <tr>
                                    <td>Ano/Modelo:</td>
                                    <td>{{veiculoBuscado.ano_modelo}}</td>
                                </tr>
                                <tr>
                                    <td>Preço:</td>
                                    <td>{{veiculoBuscado.preco}}</td>
                                </tr>
                                <tr>
                                    <td>Km:</td>
                                    <td>{{veiculoBuscado.km}} KM</td>
                                </tr>
                                <tr>
                                    <td>Cor:</td>
                                    <td>{{veiculoBuscado.cor}}</td>
                                </tr>
                                <tr>
                                    <td>Cambio:</td>
                                    <td>{{ getCambioFormatado(veiculoBuscado.cambio) }}</td>
                                </tr>
                                <tr>
                                    <td>Tipo Combustivel:</td>
                                    <td>{{ getTipoCombustivelFormatado(veiculoBuscado.tipo_combustivel) }}</td>
                                </tr>
                                <tr>
                                    <td>Descrição:</td>
                                    <td>{{veiculoBuscado.descricao}}</td>
                                </tr>
                                <tr>
                                    <td>Aceita Troca:</td>
                                    <td>{{ (veiculoBuscado.aceita_troca == 1) ? 'Sim' : 'Não'  }}</td>
                                </tr>
                                <tr>
                                    <td>IPVA Pago:</td>
                                    <td>{{ (veiculoBuscado.ipva_pago == 1) ? 'Sim' : 'Não'  }}</td>
                                </tr>
                                <tr>
                                    <td>Licenciado:</td>
                                    <td>{{ (veiculoBuscado.licenciado == 1) ? 'Sim' : 'Não'  }}</td>
                                </tr>
                                <tr>
                                    <td>Air Bag:</td>
                                    <td>{{ (veiculoBuscado.air_bag == 1) ? 'Sim' : 'Não'  }}</td>
                                </tr>
                                <tr>
                                    <td>Air Bag Duplo:</td>
                                    <td>{{ (veiculoBuscado.air_bag_duplo == 1) ? 'Sim' : 'Não'  }}</td>
                                </tr>
                                <tr>
                                    <td>Alarme:</td>
                                    <td>{{ (veiculoBuscado.alarme == 1) ? 'Sim' : 'Não'  }}</td>
                                </tr>
                                <tr>
                                    <td>Ar Condicionado Digital:</td>
                                    <td>{{ (veiculoBuscado.ar_condicionado_digital == 1) ? 'Sim' : 'Não'  }}</td>
                                </tr>
                                <tr>
                                    <td>Banco de Couro:</td>
                                    <td>{{ (veiculoBuscado.banco_couro == 1) ? 'Sim' : 'Não'  }}</td>
                                </tr>
                                <tr>
                                    <td>Banco Regulagem Altura:</td>
                                    <td>{{ (veiculoBuscado.banco_regulavel_altura == 1) ? 'Sim' : 'Não'  }}</td>
                                </tr>
                                <tr>
                                    <td>Chave Reserva:</td>
                                    <td>{{ (veiculoBuscado.chave_reserva == 1) ? 'Sim' : 'Não'  }}</td>
                                </tr>
                                <tr>
                                    <td>Computador de Bordo:</td>
                                    <td>{{ (veiculoBuscado.computador_bordo == 1) ? 'Sim' : 'Não'  }}</td>
                                </tr>
                                <tr>
                                    <td>Desembaçador Traseiro:</td>
                                    <td>{{ (veiculoBuscado.desembacador_traseiro == 1) ? 'Sim' : 'Não'  }}</td>
                                </tr>
                                <tr>
                                    <td>Direção Elétrica:</td>
                                    <td>{{ (veiculoBuscado.direcao_eletrica == 1) ? 'Sim' : 'Não'  }}</td>
                                </tr>
                                <tr>
                                    <td>Direção Escamoteável:</td>
                                    <td>{{ (veiculoBuscado.direcao_escamoteavel == 1) ? 'Sim' : 'Não'  }}</td>
                                </tr>
                                <tr>
                                    <td>Direção Multifuncional:</td>
                                    <td>{{ (veiculoBuscado.direcao_multifuncional == 1) ? 'Sim' : 'Não'  }}</td>
                                </tr>
                                <tr>
                                    <td>Faróis Auxiliares:</td>
                                    <td>{{ (veiculoBuscado.farois_auxiliares == 1) ? 'Sim' : 'Não'  }}</td>
                                </tr>
                                <tr>
                                    <td>Faróis de Led:</td>
                                    <td>{{ (veiculoBuscado.farois_led == 1) ? 'Sim' : 'Não'  }}</td>
                                </tr>
                                <tr>
                                    <td>Freios ABS:</td>
                                    <td>{{ (veiculoBuscado.freios_abs == 1) ? 'Sim' : 'Não'  }}</td>
                                </tr>
                                <tr>
                                    <td>Interface:</td>
                                    <td>{{ (veiculoBuscado.interface == 1) ? 'Sim' : 'Não'  }}</td>
                                </tr>
                                <tr>
                                    <td>Limpador Traseiro:</td>
                                    <td>{{ (veiculoBuscado.limpador_traseiro == 1) ? 'Sim' : 'Não'  }}</td>
                                </tr>
                                <tr>
                                    <td>Manual do Proprietário:</td>
                                    <td>{{ (veiculoBuscado.manual_proprietario == 1) ? 'Sim' : 'Não'  }}</td>
                                </tr>
                                <tr>
                                    <td>Porta Malas Elétrico:</td>
                                    <td>{{ (veiculoBuscado.porta_malas_eletrico == 1) ? 'Sim' : 'Não'  }}</td>
                                </tr>
                                <tr>
                                    <td>Retrovisor Elétrico:</td>
                                    <td>{{ (veiculoBuscado.retrovisor_eletrico == 1) ? 'Sim' : 'Não'  }}</td>
                                </tr>
                                <tr>
                                    <td>Roda de Liga Leve:</td>
                                    <td>{{ (veiculoBuscado.liga_leve == 1) ? 'Sim' : 'Não'  }}</td>
                                </tr>
                                <tr>
                                    <td>Sensor de Chuva:</td>
                                    <td>{{ (veiculoBuscado.sensor_chuva == 1) ? 'Sim' : 'Não'  }}</td>
                                </tr>
                                <tr>
                                    <td>Sensor de Estacionamento:</td>
                                    <td>{{ (veiculoBuscado.sensor_estacionamento == 1) ? 'Sim' : 'Não'  }}</td>
                                </tr>
                                <tr>
                                    <td>Som no Volante:</td>
                                    <td>{{ (veiculoBuscado.som_volante == 1) ? 'Sim' : 'Não'  }}</td>
                                </tr>
                                <tr>
                                    <td>Som Original:</td>
                                    <td>{{ (veiculoBuscado.som_original == 1) ? 'Sim' : 'Não'  }}</td>
                                </tr>
                                <tr>
                                    <td>Teto Panorâmico:</td>
                                    <td>{{ (veiculoBuscado.teto_panoramico == 1) ? 'Sim' : 'Não'  }}</td>
                                </tr>
                                <tr>
                                    <td>Teto Solar:</td>
                                    <td>{{ (veiculoBuscado.teto_solar == 1) ? 'Sim' : 'Não'  }}</td>
                                </tr>
                                <tr>
                                    <td>Travas Elétricas:</td>
                                    <td>{{ (veiculoBuscado.travas_eletricas == 1) ? 'Sim' : 'Não'  }}</td>
                                </tr>
                                <tr>
                                    <td>Vidros Elétricos:</td>
                                    <td>{{ (veiculoBuscado.vidros_eletricos == 1) ? 'Sim' : 'Não'  }}</td>
                                </tr>
                                <tr>
                                    <td>Ativo:</td>
                                    <td>{{ (veiculoBuscado.ativo == 1) ? 'Sim' : 'Não'  }}</td>
                                </tr>
                                <tr>
                                    <td>Destaque:</td>
                                    <td>{{ (veiculoBuscado.destaque == 1) ? 'Sim' : 'Não'  }}</td>
                                </tr>
                                <tr>
                                    <td>Recomendado:</td>
                                    <td>{{ (veiculoBuscado.recomendado == 1) ? 'Sim' : 'Não'  }}</td>
                                </tr>
                                <tr>
                                    <td>Data Criação:</td>
                                    <td>{{ formataDataTempo(veiculoBuscado.created_at) }}</td>
                                </tr>
                                <tr>
                                    <td>Data Modificação:</td>
                                    <td>{{ formataDataTempo(veiculoBuscado.updated_at) }}</td>
                                </tr>
                            </table>
                            <div v-if="imagensVeiculoBuscado.length != 0" class="row">
                                <div class="col-12">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Arquivo</th>
                                                <th>Nome</th>
                                                <th>Posição</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(imagem,key) in imagensVeiculoBuscado" :key="key">
                                                <td><a :href="urlBaseImg+'/storage/uploads/veiculo/'+imagem.id+'/'+imagem.arquivo" target="_blank"><img :src="urlBaseImg+'/storage/uploads/veiculo/'+imagem.id+'/'+imagem.arquivo" alt="Veiculo" style="width: 100%;"></a></td>
                                                <th>{{ imagem.nome_original  }}</th>
                                                <th>
                                                    <input-container-component id="posicao" idHelp="posicaoHelp" >
                                                        <input type="number" id="posicao" name="posicao" aria-describedby="posicaoHelp" v-model="posicao">
                                                    </input-container-component>
                                                    <button type="button" class="btn btn-success button-submit" @click="atualizarArquivo(imagem.id)"><i class="fa-solid fa-pen"></i></button>
                                                </th>
                                                <th><button type="button" class="btn btn-danger" @click="deletarArquivo(imagem.id)"><i class="fa-solid fa-trash"></i></button></th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Update -->
                <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="updateModalLabel" v-if="veiculoBuscado.nome">Editar: {{ veiculoBuscado.nome }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                               <div class="row">
                                   <div class="col-6">
                                       <div class="form-group" style="margin-top: 10px;">
                                           <label>Título</label>
                                           <input type="text" class="form-control" v-model="veiculoBuscado.nome">
                                       </div>
                                   </div>
                                   <div class="col-6">
                                       <div class="form-group" style="margin-top: 10px;">
                                           <label>Ano / Modelo</label>
                                           <input type="text" class="form-control" v-model="veiculoBuscado.ano_modelo">
                                       </div>
                                   </div>
                               </div>
                               <div class="row">
                                   <div class="col-6">
                                       <div class="form-group" style="margin-top: 10px;">
                                           <label>Preco</label>
                                           <input type="text" class="form-control" v-model="veiculoBuscado.preco">
                                       </div>
                                   </div>
                                   <div class="col-3">
                                       <div class="form-group" style="margin-top: 10px;">
                                           <label>Portas</label>
                                           <input type="text" class="form-control" v-model="veiculoBuscado.portas">
                                       </div>
                                   </div>
                                   <div class="col-3">
                                       <div class="form-group" style="margin-top: 10px;">
                                           <label>Quilometragem</label>
                                           <input type="text" class="form-control" v-model="veiculoBuscado.km">
                                       </div>
                                   </div>
                               </div>
                               <div class="row">
                                   <div class="col-6">
                                        <div class="form-group" style="margin-top: 10px;">
                                            <label>Cor</label>
                                            <input type="text" class="form-control" v-model="veiculoBuscado.cor">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                       <div class="form-group" style="margin-top: 10px;">
                                           <label>Câmbio</label>
                                           <select name="cambio" id="cambio" class="form-control" v-model="veiculoBuscado.cambio">
                                                <option> Selecione </option>
                                                <option value="1"> Câmbio Manual </option>
                                                <option value="2"> Câmbio Automático </option>
                                                <option value="3"> Câmbio Automático CVT </option>
                                            </select>
                                       </div>
                                   </div>
                               </div>
                               <div class="row">
                                    <div class="col-6">
                                        <div class="form-group" style="margin-top: 10px;">
                                            <label>Tipo Combustível</label>
                                            <select name="tipoCombustivel" id="tipoCombustivel" class="form-control" v-model="veiculoBuscado.tipo_combustivel">
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
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group" style="margin-top: 10px;">
                                            <label>Marca</label>
                                            <select name="marca" id="marca" class="form-control" v-model="veiculoBuscado.marca_id">
                                                <option> Selecione </option>
                                                <option :value="marca.id" v-for="marca in marcas" :key="marca.id"> {{marca.nome}} </option>
                                            </select>
                                        </div>
                                    </div>
                               </div>
                               <div class="row">
                                    <div class="col-12">
                                        <div class="form-group" style="margin-top: 10px;">
                                            <label>Descrição</label>
                                            <textarea name="descricao" class="form-control" placeholder="descricao" id="descricao" aria-describedby="descricaoHelp" style="width: 100% !important;" rows="3" cols="50" v-model="veiculoBuscado.descricao"></textarea>
                                        </div>
                                    </div>
                               </div>
                                <div class="row">
                                    <div class="col-12 form-group" style="margin-top: 10px;">
                                        <input-container-component id="novoImagem" id-help="novoImagemHelp">
                                            <br>
                                            <input type="file" class="form-control-file" id="novoImagem" aria-describedby="novoImagemHelp" placeholder="Selecione uma imagem" @change="carregarImagem($event)" multiple>
                                        </input-container-component>
                                    </div>
                                </div>
                                <br>
                                <div v-if="imagensVeiculoBuscado.length != 0" class="row">
                                    <div class="col-12">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Arquivo</th>
                                                    <th>Nome</th>
                                                    <th>Posição</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(imagem,key) in imagensVeiculoBuscado" :key="key">
                                                    <td><a :href="urlBaseImg+'/storage/uploads/veiculo/'+imagem.id+'/'+imagem.arquivo" target="_blank"><img :src="urlBaseImg+'/storage/uploads/veiculo/'+imagem.id+'/'+imagem.arquivo" alt="Veiculo" style="width: 100%;"></a></td>
                                                    <th>{{ imagem.nome_original  }}</th>
                                                    <th>
                                                        <input-container-component id="posicao" idHelp="posicaoHelp" >
                                                            <input type="number" id="posicao" name="posicao" aria-describedby="posicaoHelp" v-model="posicao">
                                                        </input-container-component>
                                                        <button type="button" class="btn btn-success button-submit" @click="atualizarArquivo(imagem.id)"><i class="fa-solid fa-pen"></i></button>
                                                    </th>
                                                    <th><button type="button" class="btn btn-danger" @click="deletarArquivo(imagem.id)"><i class="fa-solid fa-trash"></i></button></th>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row" style="margin-top: 15px;">
                                    <div class="col-4">
                                        <input type="checkbox" id="ativo" v-model="ativo">
                                        <label for="ativo">Ativo</label>
                                    </div>
                                    <div class="col-4">
                                        <input type="checkbox" id="destaque" v-model="destaque">
                                        <label for="destaque">Destaque</label>
                                    </div>
                                    <div class="col-4">
                                        <input type="checkbox" id="recomendado" v-model="recomendado">
                                        <label for="recomendado">Recomendado</label>
                                    </div>
                                </div>
                                <br>
                                <legend>Opcionais</legend>
                                <div class="row">
                                    <div class="col-3">
                                        <input-container-component titulo="Aceita Troca" id="aceitaTroca" idHelp="aceitaTrocaHelp" >
                                            <input type="checkbox" id="aceitaTroca" name="aceitaTroca" aria-describedby="aceitaTrocaHelp" v-model="aceita_troca">
                                        </input-container-component>
                                    </div>
                                    <div class="col-3">
                                        <input-container-component titulo="IPVA Pago" id="ipvaPago" idHelp="ipvaPagoHelp" >
                                            <input type="checkbox" id="ipvaPago" name="ipvaPago" aria-describedby="ipvaPagoHelp" v-model="ipva_pago">
                                        </input-container-component>
                                    </div>
                                    <div class="col-3">
                                        <input-container-component titulo="Licenciado" id="licenciado" idHelp="licenciadoHelp" >
                                            <input type="checkbox" id="licenciado" name="licenciado" aria-describedby="licenciadoHelp" v-model="licenciado">
                                        </input-container-component>
                                    </div>
                                    <div class="col-3">
                                        <input-container-component titulo="Air Bag" id="airBag" idHelp="airBagHelp" >
                                            <input type="checkbox" id="airBag" name="airBag" aria-describedby="airBagHelp" v-model="air_bag">
                                        </input-container-component>
                                    </div>
                                    <div class="col-3">
                                        <input-container-component titulo="Air Bag Duplo" id="airBagDuplo" idHelp="airBagDuploHelp" >
                                            <input type="checkbox" id="airBagDuplo" name="airBagDuplo" aria-describedby="airBagDuploHelp" v-model="air_bag_duplo">
                                        </input-container-component>
                                    </div>
                                    <div class="col-3">
                                        <input-container-component titulo="Alarme" id="alarme" idHelp="alarmeHelp" >
                                            <input type="checkbox" id="alarme" name="alarme" aria-describedby="alarmeHelp" v-model="alarme">
                                        </input-container-component>
                                    </div>
                                    <div class="col-3">
                                        <input-container-component titulo="Ar Condicionado Digital" id="arCondicionadoDigital" idHelp="arCondicionadoDigitalHelp" >
                                            <input type="checkbox" id="arCondicionadoDigital" name="arCondicionadoDigital" aria-describedby="arCondicionadoDigitalHelp" v-model="ar_condicionado_digital">
                                        </input-container-component>
                                    </div>
                                    <div class="col-3">
                                        <input-container-component titulo="Banco Couro" id="bancoCouro" idHelp="bancoCouroHelp" >
                                            <input type="checkbox" id="bancoCouro" name="bancoCouro" aria-describedby="bancoCouroHelp" v-model="banco_couro">
                                        </input-container-component>
                                    </div>
                                    <div class="col-3">
                                        <input-container-component titulo="Banco Regulagem Altura" id="bancoRegulagemAltura" idHelp="bancoRegulagemAlturaHelp" >
                                            <input type="checkbox" id="bancoRegulagemAltura" name="bancoRegulagemAltura" aria-describedby="bancoRegulagemAlturaHelp" v-model="banco_regulagem_altura">
                                        </input-container-component>
                                    </div>
                                    <div class="col-3">
                                        <input-container-component titulo="Chave Reserva" id="chaveReserva" idHelp="chaveReservaHelp" >
                                            <input type="checkbox" id="chaveReserva" name="chaveReserva" aria-describedby="chaveReservaHelp" v-model="chave_reserva">
                                        </input-container-component>
                                    </div>
                                    <div class="col-3">
                                        <input-container-component titulo="Computador Bordo" id="computadorBordo" idHelp="computadorBordoHelp" >
                                            <input type="checkbox" id="computadorBordo" name="computadorBordo" aria-describedby="computadorBordoHelp" v-model="computador_bordo">
                                        </input-container-component>
                                    </div>
                                    <div class="col-3">
                                        <input-container-component titulo="Desembaçador Traseiro" id="desembacadorTraseiro" idHelp="desembacadorTraseiroHelp" >
                                            <input type="checkbox" id="desembacadorTraseiro" name="desembacadorTraseiro" aria-describedby="desembacadorTraseiroHelp" v-model="desembacador_traseiro">
                                        </input-container-component>
                                    </div>
                                    <div class="col-3">
                                        <input-container-component titulo="Direção Elétrica" id="direcaoEletrica" idHelp="direcaoEletricaHelp" >
                                            <input type="checkbox" id="direcaoEletrica" name="direcaoEletrica" aria-describedby="direcaoEletricaHelp" v-model="direcao_eletrica">
                                        </input-container-component>
                                    </div>
                                    <div class="col-3">
                                        <input-container-component titulo="Direção Escamoteável" id="direcaoEscamoteavel" idHelp="direcaoEscamoteavelHelp" >
                                            <input type="checkbox" id="direcaoEscamoteavel" name="direcaoEscamoteavel" aria-describedby="direcaoEscamoteavelHelp" v-model="direcao_escamoteavel">
                                        </input-container-component>
                                    </div>
                                    <div class="col-3">
                                        <input-container-component titulo="Direção Multifuncional" id="direcaoMultifuncional" idHelp="direcaoMultifuncionalHelp" >
                                            <input type="checkbox" id="direcaoMultifuncional" name="direcaoMultifuncional" aria-describedby="direcaoMultifuncionalHelp" v-model="direcao_multifuncional">
                                        </input-container-component>
                                    </div>
                                    <div class="col-3">
                                        <input-container-component titulo="Faróis Auxiliares" id="faroisAuxiliares" idHelp="faroisAuxiliaresHelp" >
                                            <input type="checkbox" id="faroisAuxiliares" name="faroisAuxiliares" aria-describedby="faroisAuxiliaresHelp" v-model="farois_auxiliares">
                                        </input-container-component>
                                    </div>
                                    <div class="col-3">
                                        <input-container-component titulo="Faróis Led" id="faroisLed" idHelp="faroisLedHelp" >
                                            <input type="checkbox" id="faroisLed" name="faroisLed" aria-describedby="alarmeHelp" v-model="farois_led">
                                        </input-container-component>
                                    </div>
                                    <div class="col-3">
                                        <input-container-component titulo="Freios ABS" id="freiosAbs" idHelp="freiosAbsHelp" >
                                            <input type="checkbox" id="freiosAbs" name="freiosAbs" aria-describedby="alarmeHelp" v-model="freios_abs">
                                        </input-container-component>
                                    </div>
                                    <div class="col-3">
                                        <input-container-component titulo="Interface" id="interface" idHelp="interfaceHelp" >
                                            <input type="checkbox" id="interface" name="interface" aria-describedby="interfaceHelp" v-model="interfaces">
                                        </input-container-component>
                                    </div>
                                    <div class="col-3">
                                        <input-container-component titulo="Limpador Traseiro" id="limpadorTraseiro" idHelp="limpadorTraseiroHelp" >
                                            <input type="checkbox" id="limpadorTraseiro" name="limpadorTraseiro" aria-describedby="limpadorTraseiroHelp" v-model="limpador_traseiro">
                                        </input-container-component>
                                    </div>
                                    <div class="col-3">
                                        <input-container-component titulo="Manual do Proprietário" id="manualProprietario" idHelp="manualProprietarioHelp" >
                                            <input type="checkbox" id="manualProprietario" name="manualProprietario" aria-describedby="manualProprietarioHelp" v-model="manual_proprietario">
                                        </input-container-component>
                                    </div>
                                    <div class="col-3">
                                        <input-container-component titulo="Porta Malas Elétrico" id="portaMalasEletrico" idHelp="portaMalasEletricoHelp" >
                                            <input type="checkbox" id="portaMalasEletrico" name="portaMalasEletrico" aria-describedby="portaMalasEletricoHelp" v-model="porta_malas_eletrico">
                                        </input-container-component>
                                    </div>
                                    <div class="col-3">
                                        <input-container-component titulo="Retrovisor Elétrico" id="retrovisoEletrico" idHelp="retrovisoEletricoHelp" >
                                            <input type="checkbox" id="retrovisoEletrico" name="retrovisoEletrico" aria-describedby="retrovisoEletricoHelp" v-model="retrovisor_eletrico">
                                        </input-container-component>
                                    </div>
                                    <div class="col-3">
                                        <input-container-component titulo="Roda de Liga Leve" id="ligaleve" idHelp="ligaleveHelp" >
                                            <input type="checkbox" id="ligaleve" name="ligaleve" aria-describedby="ligaleveHelp" v-model="liga_leve">
                                        </input-container-component>
                                    </div>
                                    <div class="col-3">
                                        <input-container-component titulo="Sensor de Chuva" id="sensorChuva" idHelp="sensorChuvaHelp" >
                                            <input type="checkbox" id="sensorChuva" name="sensorChuva" aria-describedby="sensorChuvaHelp" v-model="sensor_chuva">
                                        </input-container-component>
                                    </div>
                                    <div class="col-3">
                                        <input-container-component titulo="Sensor de Estacionamento" id="sensorEstacionamento" idHelp="sensorEstacionamentoHelp" >
                                            <input type="checkbox" id="sensorEstacionamento" name="sensorEstacionamento" aria-describedby="sensorEstacionamentoHelp" v-model="sensor_estacionamento">
                                        </input-container-component>
                                    </div>
                                    <div class="col-3">
                                        <input-container-component titulo="Som no Volante" id="somVolante" idHelp="somVolanteHelp" >
                                            <input type="checkbox" id="somVolante" name="somVolante" aria-describedby="somVolanteHelp" v-model="som_volante">
                                        </input-container-component>
                                    </div>
                                    <div class="col-3">
                                        <input-container-component titulo="Som Original" id="somOriginal" idHelp="somOriginalHelp" >
                                            <input type="checkbox" id="somOriginal" name="somOriginal" aria-describedby="somOriginalHelp" v-model="som_original">
                                        </input-container-component>
                                    </div>
                                    <div class="col-3">
                                        <input-container-component titulo="Teto Panorâmico" id="tetoPanoramico" idHelp="tetoPanoramicoHelp" >
                                            <input type="checkbox" id="tetoPanoramico" name="tetoPanoramico" aria-describedby="somVolanteHelp" v-model="teto_panoramico">
                                        </input-container-component>
                                    </div>
                                    <div class="col-3">
                                        <input-container-component titulo="Teto Solar" id="tetoSolar" idHelp="tetoSolarHelp" >
                                            <input type="checkbox" id="tetoSolar" name="tetoSolar" aria-describedby="tetoSolarHelp" v-model="teto_solar">
                                        </input-container-component>
                                    </div>
                                    <div class="col-3">
                                        <input-container-component titulo="Travas Elétricas" id="travasEletricas" idHelp="travasEletricasHelp" >
                                            <input type="checkbox" id="travasEletricas" name="travasEletricas" aria-describedby="travasEletricasHelp" v-model="travas_eletricas">
                                        </input-container-component>
                                    </div>
                                    <div class="col-3">
                                        <input-container-component titulo="Vidros Elétricos" id="vidrosEletricos" idHelp="vidrosEletricosHelp" >
                                            <input type="checkbox" id="vidrosEletricos" name="vidrosEletricos" aria-describedby="vidrosEletricosHelp" v-model="vidros_eletricos">
                                        </input-container-component>
                                    </div>
                                </div>                   
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                            <button type="button" class="btn btn-success" @click="atualizar()">Salvar alterações</button>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default{
        data(){
            return {
                urlBase: 'http://localhost:8000/api/v1/veiculo',
                urlBaseImg: 'http://localhost:8000',
                urlPaginacao: '',
                urlFiltro: '',
                imagensVeiculoBuscado: [],
                arquivoImagem: [],
                nome: '',
                posicao: 0,
                veiculos: { data: [] },
                veiculoBuscado: { },
                marcas: {},
                busca: { nome:'', ativo: '' },
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
        methods: {
            getCambioFormatado(cambio){
                let cambioFormatado = '';
                if(cambio == 1){
                    cambioFormatado = 'Câmbio Manual';
                }else if(cambio == 2){
                    cambioFormatado = 'Cambio Automático';
                }else if(cambio == 3) {
                    cambioFormatado = 'Cambio Automático CVT';
                } else {
                    cambioFormatado = '';
                }
                return cambioFormatado;
            },
            getTipoCombustivelFormatado(combustivel){
                let combustivelFormatado = '';
                if(combustivel == 4){
                    combustivelFormatado = 'Flex';
                }else if(combustivel == 5){
                    combustivelFormatado = 'Diesel';
                }else if(combustivel == 6) {
                    combustivelFormatado = 'Gasolina';
                } else if(combustivel == 7) {
                    combustivelFormatado = 'GNV e Flex';
                } else if(combustivel == 8) {
                    combustivelFormatado = 'GNV e Gasolina';
                } else if(combustivel == 9) {
                    combustivelFormatado = 'Alcool';
                } else if(combustivel == 10) {
                    combustivelFormatado = 'GNV e Alcool';
                } else if(combustivel == 11) {
                    combustivelFormatado = 'Elétrico';
                } else {
                    combustivelFormatado = '';
                }
                return combustivelFormatado;
            },
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
            pesquisar(){
                let filtro = '';
                for(let chave in this.busca){
                    if(this.busca[chave]){
                        if(filtro != ''){
                            filtro += ';';
                        }
                        filtro += chave + ':like:' + this.busca[chave];
                    }
                }
                if(filtro != ''){
                    this.urlPaginacao = 'page=1';
                    this.urlFiltro = '&termo=' +filtro;
                }else{
                    this.urlFiltro = '';
                }
                this.carregarLista();
            },
            paginacao(links){
                if(links.url){
                    this.urlPaginacao = links.url.split('?')[1]; //ajustando a url de consulta com o parametro de pagina
                    this.carregarLista();  //requisitando novamente os dados para a API com a paginacao 
                }
            },
            carregarLista(){

                let url = this.urlBase + '?' +this.urlPaginacao + this.urlFiltro;

                this.$swal.showLoading();

                axios.get(url)
                    .then(response => {
                        this.veiculos  = response.data;
                        this.$swal.close();
                    })
                    .catch(errors => {
                        this.$swal("Oops...", "Algum erro aconteceu! " +errors.response.data.message, "error");
                    });
            },
            carregarMarcas(){

                let url = 'http://localhost:8000/api/v1/marca';

                this.$swal.showLoading();

                axios.get(url)
                    .then(response => {
                        this.marcas  = response.data;
                        this.$swal.close();
                    })
                    .catch(errors => {
                        this.$swal("Oops...", "Algum erro aconteceu! " +errors.response, "error");
                    });
            },
            findVeiculo(id){

                let url = this.urlBase + '/' +id;

                this.$swal.showLoading();

                if(this.veiculoBuscado){
                    this.veiculoBuscado = {};
                }

                if(this.imagensVeiculoBuscado){
                    this.imagensVeiculoBuscado = [];
                }

                axios.get(url)
                    .then(response => {
                        this.veiculoBuscado  = response.data;
                        if(response.data.arquivos){
                            for(let i=0; i<response.data.arquivos.length; i++){
                                this.imagensVeiculoBuscado[i] = response.data.arquivos[i];
                            }
                        }
                        this.aceita_troca = this.veiculoBuscado.aceita_troca == 1 ? true : false;
                        this.ipva_pago = this.veiculoBuscado.ipva_pago == 1 ? true : false;
                        this.licenciado = this.veiculoBuscado.licenciado == 1 ? true : false;
                        this.air_bag = this.veiculoBuscado.air_bag == 1 ? true : false;
                        this.air_bag_duplo = this.veiculoBuscado.air_bag_duplo == 1 ? true : false;
                        this.alarme = this.veiculoBuscado.alarme == 1 ? true : false;
                        this.ar_condicionado_digital = this.veiculoBuscado.ar_condicionado_digital == 1 ? true : false;
                        this.banco_couro = this.veiculoBuscado.banco_couro == 1 ? true : false;
                        this.banco_regulagem_altura = this.veiculoBuscado.banco_regulavel_altura == 1 ? true : false;
                        this.chave_reserva = this.veiculoBuscado.chave_reserva == 1 ? true : false;
                        this.computador_bordo = this.veiculoBuscado.computador_bordo == 1 ? true : false;
                        this.desembacador_traseiro = this.veiculoBuscado.desembacador_traseiro == 1 ? true : false;
                        this.direcao_eletrica = this.veiculoBuscado.direcao_eletrica == 1 ? true : false;
                        this.direcao_escamoteavel = this.veiculoBuscado.direcao_escamoteavel == 1 ? true : false;
                        this.direcao_multifuncional = this.veiculoBuscado.direcao_multifuncional == 1 ? true : false;
                        this.farois_auxiliares = this.veiculoBuscado.farois_auxiliares == 1 ? true : false;
                        this.farois_led = this.veiculoBuscado.farois_led == 1 ? true : false;
                        this.freios_abs = this.veiculoBuscado.freios_abs == 1 ? true : false;
                        this.interfaces = this.veiculoBuscado.interface == 1 ? true : false;
                        this.limpador_traseiro = this.veiculoBuscado.limpador_traseiro == 1 ? true : false;
                        this.manual_proprietario = this.veiculoBuscado.manual_proprietario == 1 ? true : false;
                        this.porta_malas_eletrico = this.veiculoBuscado.porta_malas_eletrico == 1 ? true : false;
                        this.retrovisor_eletrico = this.veiculoBuscado.retrovisor_eletrico == 1 ? true : false;
                        this.liga_leve = this.veiculoBuscado.liga_leve == 1 ? true : false;
                        this.sensor_chuva = this.veiculoBuscado.sensor_chuva == 1 ? true : false;
                        this.sensor_estacionamento = this.veiculoBuscado.sensor_estacionamento == 1 ? true : false;
                        this.som_volante = this.veiculoBuscado.som_volante == 1 ? true : false;
                        this.som_original = this.veiculoBuscado.som_original == 1 ? true : false;
                        this.teto_panoramico = this.veiculoBuscado.teto_panoramico == 1 ? true : false;
                        this.teto_solar = this.veiculoBuscado.teto_solar == 1 ? true : false;
                        this.travas_eletricas = this.veiculoBuscado.travas_eletricas == 1 ? true : false;
                        this.vidros_eletricos = this.veiculoBuscado.vidros_eletricos == 1 ? true : false;
                        this.ativo = this.veiculoBuscado.ativo == 1 ? true : false;
                        this.destaque = this.veiculoBuscado.destaque == 1 ? true : false;
                        this.recomendado = this.veiculoBuscado.recomendado == 1 ? true : false;
                        this.carregarMarcas();
                        this.$swal.close();
                        console.log(this.veiculoBuscado)
                    })
                    .catch(errors => {
                        this.$swal("Oops...", "Algum erro aconteceu! " +errors.message, "error");
                    });
            },
            atualizar(){
                let url = this.urlBase + '/' +this.veiculoBuscado.id;
                let formData = new FormData();
                formData.append('nome', this.veiculoBuscado.nome);
                formData.append('ano_modelo', this.veiculoBuscado.ano_modelo);
                formData.append('preco', this.veiculoBuscado.preco ? this.veiculoBuscado.preco : '');
                formData.append('portas', this.veiculoBuscado.portas ? this.veiculoBuscado.portas : '');
                formData.append('km', this.veiculoBuscado.km ? this.veiculoBuscado.km : '');
                formData.append('cor', this.veiculoBuscado.cor ? this.veiculoBuscado.cor : '');
                formData.append('cambio', this.veiculoBuscado.cambio ? this.veiculoBuscado.cambio : '');
                formData.append('marca_id', this.veiculoBuscado.marca_id ? this.veiculoBuscado.marca_id : '');
                formData.append('tipo_combustivel', this.veiculoBuscado.tipo_combustivel ? this.veiculoBuscado.tipo_combustivel : '');
                formData.append('descricao', this.veiculoBuscado.descricao ? this.veiculoBuscado.descricao : '');
                for(let i = 0; i < this.arquivoImagem.length; i++){
                    formData.append('images[]', this.arquivoImagem[i]);
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
                formData.append('_method', 'patch');

                let config = {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    }
                }

                axios.post(url, formData, config)
                    .then(response => {
                        this.findVeiculo(response.data.id);
                        document.getElementById("novoImagem").value = '';
                        this.$swal("Sucesso", "Registro atualizado com sucesso!", "success");
                    })  
                    .catch(errors => {
                        this.$swal("Oops...", "Algum erro aconteceu! " +errors.response.data.message, "error");
                    })
                
                this.carregarLista();
            },
            deletar(id) {

                let config = {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    }
                }
                
                let formData = new FormData();
                formData.append('_method', 'delete');

                let url = this.urlBase + '/' + id;
                
                this.$swal({
                    title: 'Tem certeza que deseja excluir este registro?',
                    showConfirmButton: true,
                    showCancelButton: true,
                    confirmButtonText: "OK",
                    cancelButtonText: "Cancelar",
                    icon: 'warning'
                }
                ).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        axios.post(url, formData, config)
                            .then(response => {                        
                                this.$swal("Sucesso", "Registro removido com sucesso!", "success");
                                this.carregarLista();
                            })
                            .catch(errors => {
                                this.$swal("Oops...", "Algum erro aconteceu! " +errors.response.data.message, "error");
                            })
        
                    } else
                        this.$swal('Cancelado', '', 'error')
        
                })
          
            },
            deletarArquivo(id) {

                let config = {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    }
                }

                let formData = new FormData();
                formData.append('_method', 'delete');

                let url = 'http://localhost:8000/api/v1/arquivo/excluir/' + id + "/veiculo";
                this.$swal({
                    title: 'Tem certeza que deseja excluir este arquivo?',
                    showConfirmButton: true,
                    showCancelButton: true,
                    confirmButtonText: "OK",
                    cancelButtonText: "Cancelar",
                    icon: 'warning'
                }
                ).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        axios.post(url, formData, config)
                            .then(response => {                        
                                this.$swal("Sucesso", "Arquivo removido com sucesso!", "success");
                                this.findVeiculo(this.veiculoBuscado.id);
                                document.getElementById("imagem").value = '';
                            })
                            .catch(errors => {
                                this.$swal("Oops...", "Algum erro aconteceu! " +errors.response.data.message, "error");
                            })

                    } else
                        this.$swal('Cancelado', '', 'error')

                })

            },
            carregarImagem(e) {
                this.arquivoImagem = e.target.files
            },
        },
        mounted() {
            this.carregarLista();
        }
    }
</script>
