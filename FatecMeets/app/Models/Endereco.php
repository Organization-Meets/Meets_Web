<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    protected $table = 'endereco';
    protected $primaryKey = 'id_endereco';
    public $incrementing = true;
    use HasFactory;
    protected $fillable = [
        'numero',
        'cep',
    ];
}
