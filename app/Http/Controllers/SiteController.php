<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Veiculo;
use App\Models\Banner;
use App\Models\Marca;
use App\Models\Contato;
use App\Repositories\VeiculoRepository;

class SiteController extends Controller
{
    public function __construct(Veiculo $veiculo){
        $this->veiculo = $veiculo;
    }

    public function destaque(){
        $veiculosDestaques = Veiculo::select('id', 'nome', 'descricao')->orderBy('ordem','asc')->with('arquivos')->where('ativo', 1)->where('destaque', 1)->take(3)->get()->all();

        return response()->json($veiculosDestaques, 200);
    }

    public function marcas(){
        $marcas = Marca::orderBy('nome','asc')->get()->all();

        return response()->json($marcas, 200);
    }

    public function banner(){
        $banners = Banner::select('id')->orderBy('ordem','asc')->with('arquivo')->where('ativo', 1)->get()->all();

        return response()->json($banners, 200);
    }

    public function recomendado(){
        $veiculosDestaques = Veiculo::select('id', 'nome', 'ano_modelo', 'km', 'preco')->orderBy('ordem','desc')->with('arquivos')->where('ativo', 1)->where('recomendado', 1)->take(4)->get()->all();

        return response()->json($veiculosDestaques, 200);
    }

    public function lista(Request $request){
        $veiculoRepository = new VeiculoRepository($this->veiculo);

        $veiculoRepository->selectAtributosListaSiteVeiculos();

        $veiculoRepository->selectAtributosRelacionados('arquivos');

        $veiculoRepository->selectOrderBy('data_publicacao', 'desc');

        $veiculoRepository->selectAtivos();

        if($request->has('termo')){
            $veiculoRepository->filtro($request->termo);
            
        }

        return response()->json($veiculoRepository->getResultadoPaginado(20), 200);
    }

    public function view($id)
    {
        $veiculo = $this->veiculo->with('arquivos')->find($id);
        if($veiculo === null){
            return response()->json(['erro' => 'Recurso pesquisado não existe.'], 404);
        }
        return response()->json($veiculo, 200);
    }

    public function contato(Request $request)
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
}
