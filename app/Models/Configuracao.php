<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuracao extends Model
{
    use HasFactory;

    protected $table = 'configuracoes';

    protected $fillable = ['nome', 'endereco', 'telefone', 'googlemaps', 'rodape', 'instagram', 'twitter', 'facebook', 'whatsapp', 'youtube', 'spotify'];

    public static function getConfig()
    {
        return Configuracao::find(1);
    }
}
