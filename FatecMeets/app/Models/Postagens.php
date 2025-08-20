<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Modelo que representa a tabela de postagens no banco de dados
class Postagens extends Model
{
    use HasFactory;
    protected $table = 'postagens';
    protected $primaryKey = 'id_postagens';
    public $incrementing = true;
    // Aqui você pode definir propriedades e métodos relacionados às postagens
    protected $fillable = [
        'descricao_postagem',
        'data_postagem',
        'titulo_postagem',
        'id_usuario',
        'imagem_postagem',
    ];
}