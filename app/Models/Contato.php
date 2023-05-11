<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contato extends Model
{
    use HasFactory;

    const STATUS_ABERTO = 1;
    const STATUS_RESPONDIDO = 2;

    public static $statusList = [
        self::STATUS_ABERTO => 'Aberto',
        self::STATUS_RESPONDIDO => 'Respondido'
    ];

    public function rules(){
        return [
            'nome' => 'required|max:150',
            'email' => 'required|email',
            'telefone' => 'required|max:15',
            'mensagem' => 'required',
        ];
    }

    public function feedback(){
        return [
            'required' => 'O campo :attribute deve ser preenchido',
            'nome.max' => 'O campo :attribute não pode ultrapassar 150 caracteres.',
            'telefone.max' => 'O campo :attribute não pode ultrapassar 15 caracteres.',
            'email.email' => 'Digite um email válido.'
        ];
    }
}
