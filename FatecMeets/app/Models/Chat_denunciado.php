<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat_denunciado extends Model
{
    use HasFactory;
    protected $table = 'chat_denunciado';
    protected $primaryKey = 'id_chat_denunciado';
    public $incrementing = true;
}
