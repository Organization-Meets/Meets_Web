<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lixo extends Model
{
    use HasFactory;
    protected $table = 'lixo';
    protected $primaryKey = 'id_lixo';
    public $incrementing = true;
}
