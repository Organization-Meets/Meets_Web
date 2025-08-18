<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gameficacao extends Model
{
    use HasFactory;
    protected $table = 'gameficacao';
    protected $primaryKey = 'id_gameficacao';
    public $incrementing = true;
}
