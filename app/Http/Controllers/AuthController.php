<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request){

        $credenciais = $request->all(['email', 'password']);

        //autenticacao (email e senha) auth('api') retornara um token após a autenticacao
        $token = auth('api')->attempt($credenciais);
        
        if($token){ //usuario autenticado com sucesso
            return response()->json(['token' => $token]);
        }else{ //erro de usuario ou senha
            return response()->json(['erro' => 'Usuário ou Senha inválido!'], 403);

            //401 = Unauthorized > não autorizado
            //403 = forbidden > proibido
        }

        //retornar um token JWT 
        return 'login';
    }

    public function logout(){
        auth('api')->logout();
        return response()->json(['msg' => 'Logout foi realizado com sucesso!']);
    }

    public function refresh(){
        $token = auth('api')->refresh(); //cliente encaminhe um jwt válido
        return response()->json(['token' => $token]);
    }

    public function me(){
        return response()->json(auth()->user());
    }
}
