<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Veiculo;
use App\Models\Arquivo;
use Illuminate\Http\Request;
use App\Repositories\VeiculoRepository;

class VeiculoController extends Controller
{
    public function __construct(Veiculo $veiculo){
        $this->veiculo = $veiculo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $veiculoRepository = new VeiculoRepository($this->veiculo);

        $veiculoRepository->selectAtributosRelacionados('arquivos');

        $veiculoRepository->selectAtributosRelacionados('marca');

        if($request->has('termo')){
            $veiculoRepository->filtro($request->termo);
            
        }


        return response()->json($veiculoRepository->getResultadoPaginado(10), 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $veiculo = new Veiculo();
            //validacao
            $request->validate($veiculo->rules(), $veiculo->feedback());
            $veiculo->nome = $request->input('nome');
            $veiculo->ano_modelo = $request->input('ano_modelo');
            $veiculo->preco = $request->input('preco');
            $veiculo->portas = $request->input('portas');
            $veiculo->cor = $request->input('cor');
            $veiculo->cambio = $request->input('cambio');
            $veiculo->descricao = $request->input('descricao');
            $veiculo->marca_id = $request->input('marca_id');
            $veiculo->tipo_combustivel = $request->input('tipo_combustivel');
            $veiculo->aceita_troca = $request->input('aceita_troca');
            $veiculo->ipva_pago = $request->input('ipva_pago');
            $veiculo->licenciado = $request->input('licenciado');
            $veiculo->air_bag = $request->input('air_bag');
            $veiculo->air_bag_duplo = $request->input('air_bag_duplo');
            $veiculo->alarme = $request->input('alarme');
            $veiculo->ar_condicionado_digital = $request->input('ar_condicionado_digital');
            $veiculo->banco_couro = $request->input('banco_couro');
            $veiculo->banco_regulavel_altura = $request->input('banco_regulavel_altura');
            $veiculo->chave_reserva = $request->input('chave_reserva');
            $veiculo->computador_bordo = $request->input('computador_bordo');
            $veiculo->desembacador_traseiro = $request->input('desembacador_traseiro');
            $veiculo->direcao_eletrica = $request->input('direcao_eletrica');
            $veiculo->direcao_escamoteavel = $request->input('direcao_escamoteavel');
            $veiculo->direcao_multifuncional = $request->input('direcao_multifuncional');
            $veiculo->farois_auxiliares = $request->input('farois_auxiliares');
            $veiculo->farois_led = $request->input('farois_led');
            $veiculo->freios_abs = $request->input('freios_abs');
            $veiculo->interface = $request->input('interface');
            $veiculo->limpador_traseiro = $request->input('limpador_traseiro');
            $veiculo->manual_proprietario = $request->input('manual_proprietario');
            $veiculo->porta_malas_eletrico = $request->input('porta_malas_eletrico');
            $veiculo->retrovisor_eletrico = $request->input('retrovisor_eletrico');
            $veiculo->liga_leve = $request->input('liga_leve');
            $veiculo->sensor_chuva = $request->input('sensor_chuva');
            $veiculo->sensor_estacionamento = $request->input('sensor_estacionamento');
            $veiculo->som_volante = $request->input('som_volante');
            $veiculo->som_original = $request->input('som_original');
            $veiculo->teto_panoramico = $request->input('teto_panoramico');
            $veiculo->teto_solar = $request->input('teto_solar');
            $veiculo->travas_eletricas = $request->input('travas_eletricas');
            $veiculo->vidros_eletricos = $request->input('vidros_eletricos');
            $veiculo->ativo = $request->input('ativo');
            $veiculo->destaque = $request->input('destaque');
            $veiculo->recomendado = $request->input('recomendado');
            $veiculo->km = $request->input('km');
        
            $veiculo->save();

            $table = 'veiculo';
            // Define o valor default para a variável que contém o nome da imagem 
            $nameFile = null;
            
            // Verifica se informou o arquivo e se é válido
            if($request->hasFile('images')){
                for($i = 0; $i < count($request->allFiles()['images']); $i++){
                    if ($request->allFiles()['images'][$i]->isValid()) {
                        $arquivo = new Arquivo();
                        // Define um aleatório para o arquivo baseado no timestamps atual
                        
                        $name = uniqid(date('HisYmd'));
                        // Recupera a extensão do arquivo
                        $extension = $request->allFiles()['images'][$i]->extension();
                
                        // Define finalmente o nome
                        $nameFile = "{$name}.{$extension}";
        
                        $arquivo->arquivo = $nameFile;
                        $arquivo->tamanho = $request->allFiles()['images'][$i]->getSize();
                        $arquivo->tipo_mime = $request->allFiles()['images'][$i]->getMimeType();
                        $arquivo->nome_original = $request->allFiles()['images'][$i]->getClientOriginalName();
                        $arquivo->tipo = Arquivo::TIPO_IMAGEM;
                        $arquivo->veiculo_id = $veiculo->id;
                        $arquivo->save();
                        
                        $uploadPath = "uploads/".$table."/".$arquivo->id;
                        // Faz o upload:
                        $upload = $request->allFiles()['images'][$i]->storeAs($uploadPath, $nameFile);
                
                        // Verifica se NÃO deu certo o upload (Redireciona de volta)
                        if ( !$upload ){
                            return response()->json(['erro' => 'Não foi possível fazer upload do arquivo.'], 400);
                        }
                        $nameFile = null;
                        unset($arquivo);
                        
                    }
                }
            }

        
            return response()->json($veiculo, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Veiculo  $veiculo
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $veiculo = $this->veiculo->with('arquivos')->with('marca')->find($id);
        if($veiculo === null){
            return response()->json(['erro' => 'Recurso pesquisado não existe.'], 404);
        }
        return response()->json($veiculo, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Veiculo  $veiculo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Veiculo $veiculo)
    {
        //validar apenas campos enviados
        if($request->method() === 'PATCH'){
            $regrasDinamicas= array();
            //percorrer todas as regras definidas no model
            foreach($veiculo->rules() as $input => $regras){
                //coletar apenas as regras aplicavéis ao parametros parciais da requisicao PATCH
                if(array_key_exists($input, $request->all())){
                    $regrasDinamicas[$input] = $regras;
                }
            }
            $request->validate($regrasDinamicas, $veiculo->feedback());
        }else{ 
            //validacao
            $request->validate($veiculo->rules(), $veiculo->feedback());
        }
        
        $table = 'veiculo';
        // Define o valor default para a variável que contém o nome da imagem 
        $nameFile = null;

        // Verifica se informou o arquivo e se é válido
        if($request->hasFile('images')){
            for($i = 0; $i < count($request->allFiles()['images']); $i++){
                if ($request->allFiles()['images'][$i]->isValid()) {
                    $arquivo = new Arquivo();
                    // Define um aleatório para o arquivo baseado no timestamps atual
                    
                    $name = uniqid(date('HisYmd'));
                    // Recupera a extensão do arquivo
                    $extension = $request->allFiles()['images'][$i]->extension();
            
                    // Define finalmente o nome
                    $nameFile = "{$name}.{$extension}";
    
                    $arquivo->arquivo = $nameFile;
                    $arquivo->tamanho = $request->allFiles()['images'][$i]->getSize();
                    $arquivo->tipo_mime = $request->allFiles()['images'][$i]->getMimeType();
                    $arquivo->nome_original = $request->allFiles()['images'][$i]->getClientOriginalName();
                    $arquivo->tipo = Arquivo::TIPO_IMAGEM;
                    $arquivo->veiculo_id = $veiculo->id;
                    $arquivo->save();
                    
                    $uploadPath = "uploads/".$table."/".$arquivo->id;
                    // Faz o upload:
                    $upload = $request->allFiles()['images'][$i]->storeAs($uploadPath, $nameFile);
                    // Se tiver funcionado o arquivo foi armazenado em storage/app/public/categories/nomedinamicoarquivo.extensao
            
                    // Verifica se NÃO deu certo o upload (Redireciona de volta)
                    if ( !$upload ){
                        return redirect()->back();
                        alert()->error('ErrorAlert','Não foi possível fazer upload do arquivo.');
                    }
                    $nameFile = null;
                    unset($arquivo);
                    
                }
            }
        }

        if($request->has('tipo_combustivel') == null){
            $veiculo->tipo_combustivel = 0;
        }
        if($request->has('aceita_troca') == null){
            $veiculo->aceita_troca = 0;
        }  if($request->has('ipva_pago') == null){
            $veiculo->ipva_pago = 0;
        }  if($request->has('licenciado') == null){
            $veiculo->licenciado = 0;
        }  if($request->has('air_bag') == null){
            $veiculo->air_bag = 0;
        }  if($request->has('air_bag_duplo') == null){
            $veiculo->air_bag_duplo = 0;
        }  if($request->has('alarme') == null){
            $veiculo->alarme = 0;
        }  if($request->has('ar_condicionado_digital') == null){
            $veiculo->ar_condicionado_digital = 0;
        }  if($request->has('banco_couro') == null){
            $veiculo->banco_couro = 0;
        }  if($request->has('banco_regulavel_altura') == null){
            $veiculo->banco_regulavel_altura = 0;
        }  if($request->has('chave_reserva') == null){
            $veiculo->chave_reserva = 0;
        }  if($request->has('computador_bordo') == null){
            $veiculo->computador_bordo = 0;
        }  if($request->has('desembacador_traseiro') == null){
            $veiculo->desembacador_traseiro = 0;
        }  if($request->has('direcao_eletrica') == null){
            $veiculo->direcao_eletrica = 0;
        }  if($request->has('direcao_escamoteavel') == null){
            $veiculo->direcao_escamoteavel = 0;
        }  if($request->has('direcao_multifuncional') == null){
            $veiculo->direcao_multifuncional = 0;
        }  if($request->has('farois_auxiliares') == null){
            $veiculo->farois_auxiliares = 0;
        }  if($request->has('farois_led') == null){
            $veiculo->farois_led = 0;
        }  if($request->has('freios_abs') == null){
            $veiculo->freios_abs = 0;
        }  if($request->has('interface') == null){
            $veiculo->interface = 0;
        }  if($request->has('limpador_traseiro') == null){
            $veiculo->limpador_traseiro = 0;
        }  if($request->has('manual_proprietario') == null){
            $veiculo->manual_proprietario = 0;
        }  if($request->has('porta_malas_eletrico') == null){
            $veiculo->porta_malas_eletrico = 0;
        }  if($request->has('retrovisor_eletrico') == null){
            $veiculo->retrovisor_eletrico = 0;
        }  if($request->has('liga_leve') == null){
            $veiculo->liga_leve = 0;
        }  if($request->has('sensor_chuva') == null){
            $veiculo->sensor_chuva = 0;
        }  if($request->has('sensor_estacionamento') == null){
            $veiculo->sensor_estacionamento = 0;
        }  if($request->has('som_volante') == null){
            $veiculo->som_volante = 0;
        }  if($request->has('som_original') == null){
            $veiculo->som_original = 0;
        }  if($request->has('teto_panoramico') == null){
            $veiculo->teto_panoramico = 0;
        }  if($request->has('teto_solar') == null){
            $veiculo->teto_solar = 0;
        }  if($request->has('travas_eletricas') == null){
            $veiculo->travas_eletricas = 0;
        }  if($request->has('vidros_eletricos') == null){
            $veiculo->vidros_eletricos = 0;
        }   if($request->has('ativo') == null){
            $veiculo->ativo = 0;
        }  if($request->has('recomendado') == null){
            $veiculo->recomendado = 0;
        }  if($request->has('destaque') == null){
            $veiculo->destaque = 0;
        }
            
        //preencher o objeto somente com os dados do request    
        $veiculo->fill($request->all());
        $veiculo->save();
        //vai preencher o objeto de acordo com a variavel fillable no model
        //$veiculo->update($request->all());
        return response()->json($veiculo, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Veiculo  $veiculo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Veiculo $veiculo)
    {
        if($veiculo->arquivos){
            if(count($veiculo->arquivos) != 0){
                foreach($veiculo->arquivos as $arquivo){
                    if(Storage::exists("/uploads/veiculo/{$arquivo->id}/{$arquivo->arquivo}")){
                        if(unlink(public_path('/storage/uploads/veiculo/'.$arquivo->id.'/'.$arquivo->arquivo))){
                            rmdir(public_path('/storage/uploads/veiculo/'.$arquivo->id));
                        }
                    }else{
                        return response()->json(['erro' => 'Arquivo não existe.'], 404);
                    }
                    $arquivo->delete();
                    $veiculo->delete();
                }
                return response()->json(['msg' => 'Registro deletado com sucesso!'], 200);
            }else{
                $veiculo->delete();
                return response()->json(['msg' => 'Registro deletado com sucesso!'], 200);
            }
        }
    }
}
