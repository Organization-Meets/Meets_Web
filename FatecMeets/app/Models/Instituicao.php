<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instituicao extends Model
{
    use HasFactory;
    protected $table = 'instituicao';
    protected $primaryKey = 'id_instituicao';
    public $incrementing = true;
    protected $fillable = [
        'nome_instituicao',
        'codigo_instituicional',
        'id_endereco', // ID do endereço associado à instituição
    ];
}