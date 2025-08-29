<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;
    protected $table = 'eventos';

    protected $fillable = [
        'data_inicio_evento',
        'data_final_evento',
        'descricao',
        'nome_evento',
        'id_usuario', // ID do usuário que criou o evento
        'imagem_evento',
        'id_complemento',
    ];
}