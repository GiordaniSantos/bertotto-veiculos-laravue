<?php

namespace App\Http\Controllers;

use App\Models\Configuracao;
use Illuminate\Http\Request;

class ConfiguracaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Configuracao  $configuracao
     * @return \Illuminate\Http\Response
     */
    public function show(Configuracao $configuracao)
    {
        if($configuracao === null){
            return response()->json(['erro' => 'Recurso pesquisado não existe.'], 404);
        }
        return response()->json($configuracao, 200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Configuracao  $configuracao
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Configuracao $configuracao)
    {
        //vai preencher o objeto de acordo com a variavel fillable no model
        $configuracao->update($request->all());
        return response()->json($configuracao, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Configuracao  $configuracao
     * @return \Illuminate\Http\Response
     */
    public function destroy(Configuracao $configuracao)
    {
        //
    }
}
