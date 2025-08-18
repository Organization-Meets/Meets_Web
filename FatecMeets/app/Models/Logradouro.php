<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logradouro extends Model
{
    protected $table = 'logradouro';
    protected $primaryKey = 'id_logradouro';
    public $incrementing = true;
    use HasFactory;
}
