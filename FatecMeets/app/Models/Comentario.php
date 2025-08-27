<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Modelo que representa a tabela de comentários no banco de dados
class Comentarios extends Model
{
    use HasFactory;
    protected $fillable = [
        'data_comentario',
        'descricao_comentario',
        'id_usuario',
    ];
    protected $hidden = [
        'id_usuario', // Oculta o ID do usuário associado ao comentário
    ];
}