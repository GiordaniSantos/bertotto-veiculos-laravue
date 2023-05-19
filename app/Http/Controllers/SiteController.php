<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Veiculo;
use App\Models\Banner;

class SiteController extends Controller
{
    public function destaque(){
        $veiculosDestaques = Veiculo::orderBy('id','desc')->with('arquivos')->where('ativo', 1)->where('destaque', 1)->take(3)->get()->all();

        return response()->json($veiculosDestaques, 200);
    }

    public function banner(){
        $banners = Banner::orderBy('ordem','asc')->with('arquivo')->where('ativo', 1)->get()->all();

        return response()->json($banners, 200);
    }
}
