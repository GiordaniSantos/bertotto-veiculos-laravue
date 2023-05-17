<?php

namespace App\Http\Controllers;

use App\Models\Contato;
use Illuminate\Http\Request;
use App\Repositories\ContatoRepository;

class ContatoController extends Controller
{
    public function __construct(Contato $contato){
        $this->contato = $contato;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $contatoRepository = new ContatoRepository($this->contato);


        if($request->has('termo')){
            $contatoRepository->filtro($request->termo);
            
        }


        return response()->json($contatoRepository->getResultadoPaginado(10), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $contato = new Contato();
            //validacao
            $request->validate($contato->rules(), $contato->feedback());
            //vai preencher o objeto de acordo com o request
            $contato->nome = $request->input('nome');
            $contato->email = $request->input('email');
            $contato->telefone = $request->input('telefone');
            $contato->mensagem = $request->input('mensagem');
            $contato->status = Contato::STATUS_ABERTO;
            $contato->ativo = 1;
            $retorno = $contato->save();
            return response()->json($retorno, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contato  $contato
     * @return \Illuminate\Http\Response
     */
    public function show(Contato $contato)
    {
        if($contato === null){
            return response()->json(['erro' => 'Recurso pesquisado não existe.'], 404);
        }
        return response()->json($contato, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contato  $contato
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contato $contato)
    {
        if($contato === null){
            return response()->json(['erro' => 'Impossível realizar à atualização.'], 404);
        }

        //validar apenas campos enviados
       /* if($request->method() === 'PATCH'){
            $regrasDinamicas= array();
            //percorrer todas as regras definidas no model
            foreach($contato->rules() as $input => $regra){
                //coletar apenas as regras aplicavéis ao parametros parciais da requisicao PATCH
                if(array_key_exists($input, $request->all())){
                    $regrasDinamicas[$input] = $regras;
                }
            }
            $request->validate($regrasDinamicas, $feedback);
        }else{ */
            //validacao
            $regras = [
                'resposta' => 'required'
            ];
    
            $feedback = [
                'required' => 'O campo :attribute deve ser preenchido'
            ];
            $request->validate($regras, $feedback);
        //}
        //vai preencher o objeto de acordo com o request
        $contato->resposta = $request->input('resposta');
        $contato->status = $request->input('status');
        $contato->data_resposta = new \DateTime();
        $contato->ativo = 1;
        $contato->update();
        return response()->json($contato, 200);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contato  $contato
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contato $contato)
    {
        if($contato === null){
            return response()->json(['erro' => 'Impossível realizar a exclusão.'], 404);
        }
        $contato->delete();
        return response()->json(['msg' => 'Registro deletado com sucesso!'], 200);
    }
}
