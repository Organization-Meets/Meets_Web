<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adicionais extends Model
{
    use HasFactory;
    protected $table = 'adicionais';
    protected $primaryKey = 'id_adicionais';
    public $incrementing = true;
}
