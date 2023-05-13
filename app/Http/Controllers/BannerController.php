<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Banner;
use App\Models\Arquivo;
use Illuminate\Http\Request;
use App\Repositories\BannerRepository;

class BannerController extends Controller
{
    public function __construct(Banner $banner){
        $this->banner = $banner;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $bannerRepository = new BannerRepository($this->banner);

        $bannerRepository->selectAtributosRelacionados('arquivo');

        if($request->has('termo')){
            $bannerRepository->filtro($request->termo);
            
        }


        return response()->json($bannerRepository->getResultadoPaginado(20), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

            //validacao
            $banner = new Banner();
            $request->validate($banner->rules(), $banner->feedback());
            //vai preencher o objeto de acordo com o request
            $banner->titulo = $request->input('titulo');
            $banner->link = $request->input('link');
            $banner->ordem = $request->input('ordem');
            if($request->input('nova_guia')){
                $banner->nova_guia = $request->input('nova_guia');
            }else{
                $banner->nova_guia = 0;
            }
            if($request->input('ativo')){
                $banner->ativo = $request->input('ativo');
            }else{
                $banner->ativo = 0;
            }
            $banner->save();

            $table = 'banner';
            // Define o valor default para a variável que contém o nome da imagem 
            $nameFile = null;
            $arquivo = new Arquivo();
            
        
            // Verifica se informou o arquivo e se é válido
            if ($request->hasFile('arquivo') && $request->file('arquivo')->isValid()) {
            
                // Define um aleatório para o arquivo baseado no timestamps atual
                $name = uniqid(date('HisYmd'));
        
                // Recupera a extensão do arquivo
                $extension = $request->arquivo->extension();
        
                // Define finalmente o nome
                $nameFile = "{$name}.{$extension}";

                $arquivo->arquivo = $nameFile;
                $arquivo->tamanho = $request->arquivo->getSize();
                $arquivo->tipo_mime = $request->arquivo->getMimeType();
                $arquivo->nome_original = $request->arquivo->getClientOriginalName();
                $arquivo->posicao = 1;
                $arquivo->tipo = 'I';
                $arquivo->banner_id = $banner->id;
                $arquivo->save();
                
                $uploadPath = "uploads/".$table."/".$arquivo->id;
                // Faz o upload:
                $upload = $request->arquivo->storeAs($uploadPath, $nameFile);
                // Se tiver funcionado o arquivo foi armazenado em storage/app/public/categories/nomedinamicoarquivo.extensao
        
                // Verifica se NÃO deu certo o upload (Redireciona de volta)
                if ( !$upload ){
                    return response()->json(['erro' => 'Não foi possível fazer upload do arquivo.'], 400);
                }
            }

            return response()->json($banner, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $banner = $this->banner->with('arquivo')->find($id);
        if($banner === null){
            return response()->json(['erro' => 'Recurso pesquisado não existe.'], 404);
        }
        return response()->json($banner, 200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banner $banner)
    {
        //validar apenas campos enviados
        if($request->method() === 'PATCH'){
            $regrasDinamicas= array();
            //percorrer todas as regras definidas no model
            foreach($banner->rules() as $input => $regras){
                //coletar apenas as regras aplicavéis ao parametros parciais da requisicao PATCH
                if(array_key_exists($input, $request->all())){
                    $regrasDinamicas[$input] = $regras;
                }
            }
            $request->validate($regrasDinamicas, $banner->feedback());
        }else{ 
            //validacao
            $request->validate($banner->rules(), $banner->feedback());
        }

            $table = 'banner';
                // Define o valor default para a variável que contém o nome da imagem 
            $nameFile = null;
        
            // Verifica se informou o arquivo e se é válido
            if ($request->hasFile('arquivo') && $request->file('arquivo')->isValid()) {
                //se o banner tiver arquivo
                if($banner->arquivo){
                    //remover aquivo do $banner->arquivo da pasta uploads
                    if(Storage::exists("/uploads/banner/{$banner->arquivo->id}/{$banner->arquivo->arquivo}")){
                        Storage::delete("/uploads/banner/{$banner->arquivo->id}/{$banner->arquivo->arquivo}");
                    }else{
                        return response()->json(['erro' => 'Arquivo não existe.'], 404);
                    }
                    //setar o arquivo do $banner->arquivo com a $request
                    // Define nome um aleatório para o arquivo baseado no timestamps atual
                    $name = uniqid(date('HisYmd'));
            
                    // Recupera a extensão do arquivo
                    $extension = $request->arquivo->extension();
            
                    // Define finalmente o nome
                    $nameFile = "{$name}.{$extension}";

                    $banner->arquivo->arquivo = $nameFile;
                    $banner->arquivo->tamanho = $request->arquivo->getSize();
                    $banner->arquivo->tipo_mime = $request->arquivo->getMimeType();
                    $banner->arquivo->nome_original = $request->arquivo->getClientOriginalName();
                    $banner->arquivo->posicao = 1;
                    $banner->arquivo->tipo = 'I';
                    
                    $banner->arquivo->update();
                    
                    $uploadPath = "uploads/".$table."/".$banner->arquivo->id;
                    // Faz o upload:
                    $upload = $request->arquivo->storeAs($uploadPath, $nameFile);
            
                    // Verifica se NÃO deu certo o upload (Redireciona de volta)
                    if ( !$upload ){
                        return response()->json(['erro' => 'Não foi possível fazer upload do arquivo.'], 400);
                    }
                }else{
                    $arquivo = new Arquivo();
                    // Define um aleatório para o arquivo baseado no timestamps atual
                    $name = uniqid(date('HisYmd'));
            
                    // Recupera a extensão do arquivo
                    $extension = $request->arquivo->extension();
            
                    // Define finalmente o nome
                    $nameFile = "{$name}.{$extension}";

                    $arquivo->arquivo = $nameFile;
                    $arquivo->tamanho = $request->arquivo->getSize();
                    $arquivo->tipo_mime = $request->arquivo->getMimeType();
                    $arquivo->nome_original = $request->arquivo->getClientOriginalName();
                    $arquivo->posicao = 1;
                    $arquivo->tipo = 'I';
                    $arquivo->banner_id = $banner->id;
                    $arquivo->save();
                    
                    $uploadPath = "uploads/".$table."/".$arquivo->id;
                    // Faz o upload:
                    $upload = $request->arquivo->storeAs($uploadPath, $nameFile);
                    // Se tiver funcionado o arquivo foi armazenado em storage/app/public/categories/nomedinamicoarquivo.extensao
            
                    // Verifica se NÃO deu certo o upload (Redireciona de volta)
                    if ( !$upload ){
                        return response()->json(['erro' => 'Não foi possível fazer upload do arquivo.'], 400);
                    }
                }
            }
            
            if($request->has('ativo') == null){
                $banner->ativo = 0;
            }
            if($request->has('nova_guia') == null){
                $banner->nova_guia = 0;
            }
            //preencher o objeto somente com os dados do request    
            $banner->fill($request->all());
            $banner->save();
            //vai preencher o objeto de acordo com a variavel fillable no model
            //$banner->update($request->all());
            return response()->json($banner, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner)
    {
        if($banner->arquivo){
            if(Storage::exists("/uploads/banner/{$banner->arquivo->id}/{$banner->arquivo->arquivo}")){
                if(unlink(public_path('/storage/uploads/banner/'.$banner->arquivo->id.'/'.$banner->arquivo->arquivo))){
                    rmdir(public_path('/storage/uploads/banner/'.$banner->arquivo->id));
                }
            }else{
                return response()->json(['erro' => 'Arquivo não existe.'], 404);
            }
            $banner->arquivo->delete();
            $banner->delete();
        }else if(!$banner->arquivo){
            $banner->delete();
        }else{
             // Em caso de falhas redireciona o usuário de volta e informa que não foi possível deletar
            return response()->json(['erro' => 'Não foi possível deletar.'], 400);
        }

        return response()->json(['msg' => 'Registro deletado com sucesso!'], 200);
    }
}
