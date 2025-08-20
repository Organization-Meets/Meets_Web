<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario_Evento extends Model
{
    use HasFactory;
    protected $table = 'comentario_evento';
    protected $primaryKey = 'id_comentario_evento';
    public $incrementing = true;
}
