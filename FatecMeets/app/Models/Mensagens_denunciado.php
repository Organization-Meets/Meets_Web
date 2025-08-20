<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mensagens_denunciado extends Model
{
    use HasFactory;
    protected $table = 'mensagens_denunciado';
    protected $primaryKey = 'id_mensagens_denunciado';
    public $incrementing = true;
}
