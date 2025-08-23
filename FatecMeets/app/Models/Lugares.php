<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lugares extends Model
{
    use HasFactory;
    protected $table = 'lugares';
    protected $primaryKey = 'id_lugar';
    public $incrementing = true;

    // App\Models\Lugares.php
    protected $fillable = ['id_endereco', 'nome_lugares', 'id_administrador'];

}
