<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento_denunciado extends Model
{
    use HasFactory;
    protected $table = 'evento_denunciado';
    protected $primaryKey = 'id_evento_denunciado';
    public $incrementing = true;
}
