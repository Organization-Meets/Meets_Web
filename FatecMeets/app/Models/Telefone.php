<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Telefone extends Model
{
    use HasFactory;
    protected $table = 'telefone';
    protected $primaryKey = 'id_telefone';
    public $incrementing = true;
    protected $fillable = [
        'numero_telefone',
        'ddd',
    ];

}
