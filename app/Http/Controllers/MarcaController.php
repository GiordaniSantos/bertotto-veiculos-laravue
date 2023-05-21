<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;
use App\Repositories\MarcaRepository;

class MarcaController extends Controller
{
    public function __construct(Marca $marca){
        $this->marca = $marca;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $marcaRepository = new MarcaRepository($this->marca);

        return response()->json($marcaRepository->getResultado(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $marca = new Marca();
        //validacao
        $request->validate($marca->rules(), $marca->feedback());
        //vai preencher o objeto de acordo com o request
        $marca->nome = $request->input('nome');
        $retorno = $marca->save();
        return response()->json($retorno, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function show(Marca $marca)
    {
        if($marca === null){
            return response()->json(['erro' => 'Recurso pesquisado não existe.'], 404);
        }
        return response()->json($marca, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Marca $marca)
    {
        if($marca === null){
            return response()->json(['erro' => 'Impossível realizar à atualização.'], 404);
        }
        //validacao
        $request->validate($marca->rules(), $marca->feedback());
        //vai preencher o objeto de acordo com o request
        $marca->nome = $request->input('nome');
        $marca->update();
        return response()->json($marca, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function destroy(Marca $marca)
    {
        if($marca === null){
            return response()->json(['erro' => 'Impossível realizar a exclusão.'], 404);
        }
        $marca->delete();
        return response()->json(['msg' => 'Registro deletado com sucesso!'], 200);
    }
}
