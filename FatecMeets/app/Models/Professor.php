<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    use HasFactory;
    protected $table = 'professor';
    protected $primaryKey = 'id_professor';
    public $incrementing = true;
    protected $fillable = [
        'nome_professor',
        'ra_professor',
        'id_usuario',
    ];
}
