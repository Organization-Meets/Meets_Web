<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postagens_denunciado extends Model
{
    use HasFactory;
    protected $table = 'postagens_denunciado';
    protected $primaryKey = 'id_postagens_denunciado';
    public $incrementing = true;
}
