<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Veiculo;
use App\Models\Banner;
use App\Repositories\VeiculoRepository;

class SiteController extends Controller
{
    public function __construct(Veiculo $veiculo){
        $this->veiculo = $veiculo;
    }

    public function destaque(){
        $veiculosDestaques = Veiculo::select('id', 'nome', 'descricao')->orderBy('id','desc')->with('arquivos')->where('ativo', 1)->where('destaque', 1)->take(3)->get()->all();

        return response()->json($veiculosDestaques, 200);
    }

    public function banner(){
        $banners = Banner::select('id')->orderBy('ordem','asc')->with('arquivo')->where('ativo', 1)->get()->all();

        return response()->json($banners, 200);
    }

    public function recomendado(){
        $veiculosDestaques = Veiculo::select('id', 'nome', 'ano_modelo', 'km', 'preco')->orderBy('id','desc')->with('arquivos')->where('ativo', 1)->where('recomendado', 1)->take(4)->get()->all();

        return response()->json($veiculosDestaques, 200);
    }

    public function lista(Request $request){
        $veiculoRepository = new VeiculoRepository($this->veiculo);

        $veiculoRepository->selectAtributosListaSiteVeiculos();

        $veiculoRepository->selectAtributosRelacionados('arquivos');

        if($request->has('termo')){
            $veiculoRepository->filtro($request->termo);
            
        }


        return response()->json($veiculoRepository->getResultadoPaginado(16), 200);
    }

    public function view($id)
    {
        $veiculo = $this->veiculo->with('arquivos')->find($id);
        if($veiculo === null){
            return response()->json(['erro' => 'Recurso pesquisado não existe.'], 404);
        }
        return response()->json($veiculo, 200);
    }
}
