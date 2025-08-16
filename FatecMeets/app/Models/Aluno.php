<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    use HasFactory;
    protected $table = 'aluno';
    protected $primaryKey = 'id_aluno';
    public $incrementing = true;
    protected $fillable = [
        'ra_aluno',
        'id_usuario',
        'nome_aluno',
    ];
}