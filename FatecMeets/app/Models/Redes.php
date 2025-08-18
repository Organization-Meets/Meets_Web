<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Redes extends Model
{
    use HasFactory;
    protected $table = 'redes';
    protected $primaryKey = 'id_redes';
    public $incrementing = true;
}
