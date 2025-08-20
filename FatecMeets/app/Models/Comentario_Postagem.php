<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario_Postagem extends Model
{
    use HasFactory;
    protected $table = 'comentario_postagem';
    protected $primaryKey = 'id_comentario_postagem';
    public $incrementing = true;
}
