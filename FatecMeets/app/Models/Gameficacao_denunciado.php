<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gameficacao_denunciado extends Model
{
    use HasFactory;
    protected $table = 'gameficacao_denunciado';
    protected $primaryKey = 'id_gameficacao_denunciado';
    public $incrementing = true;
}
