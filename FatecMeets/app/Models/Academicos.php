<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Academicos extends Model
{
    use HasFactory;
    protected $table = 'academicos';
    protected $primaryKey = 'id_academicos';
    public $incrementing = true;
}
