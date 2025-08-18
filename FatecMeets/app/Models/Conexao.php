<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conexao extends Model
{
    use HasFactory;
    protected $table = 'conexao';
    protected $primaryKey = 'id_conexao';
    public $incrementing = true;
}
