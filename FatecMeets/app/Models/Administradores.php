<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administradores extends Model
{
    use HasFactory;
    protected $table = 'administradores';
    protected $primaryKey = 'id_administrador';
    public $incrementing = true;

    // App\Models\Administradores.php
    protected $fillable = ['id_usuario', 'nome_administrador'];

}
