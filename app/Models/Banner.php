<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    
    protected $fillable = ['titulo', 'link', 'ordem', 'ativo', 'nova_guia'];

    public function rules(){
        return [
            'titulo' => 'required|max:256',
            'link' => 'max:256',
            'ordem' => 'required',
            'arquivo' => 'image'
        ];
    }

    public function feedback(){
        return [
            'required' => 'O campo :attribute deve ser preenchido',
            'titulo.max' => 'O campo :attribute não pode ultrapassar 256 caracteres.',
            'link.max' => 'O campo :attribute não pode ultrapassar 256 caracteres.',
            'arquivo.image' => "Tipo não suportado, envie uma imagem ('jpg, jpeg, png...')"
        ];
    }
    
    public function arquivo(){
        return $this->hasOne('App\Models\Arquivo', 'banner_id');
    }
}
