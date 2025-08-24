<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gameficacao extends Model
{
    use HasFactory;

    // Nome da tabela
    protected $table = 'gameficacao';

    // Primary Key
    protected $primaryKey = 'id_gameficacao';

    // PK auto-incremento
    public $incrementing = true;

    // Colunas que podem ser preenchidas em massa
    protected $fillable = [
        'nickname',
        'score_total',
        'id_usuario',
    ];
}
