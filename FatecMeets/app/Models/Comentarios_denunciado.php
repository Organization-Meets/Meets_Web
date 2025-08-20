<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentarios_denunciado extends Model
{
    use HasFactory;
    protected $table = 'comentarios_denunciado';
    protected $primaryKey = 'id_comentario_denunciado';
    public $incrementing = true;
}
