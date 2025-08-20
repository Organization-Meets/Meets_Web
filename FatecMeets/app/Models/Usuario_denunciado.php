<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario_denunciado extends Model
{
    use HasFactory;
    protected $table = 'usuario_denunciado';
    protected $primaryKey = 'id_usuario_denunciado';
    public $incrementing = true;
}
