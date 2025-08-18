<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Intencao extends Model
{
    use HasFactory;
    protected $table = 'intencao';
    protected $primaryKey = 'id_intencao';
    public $incrementing = true;
    protected $fillable = [
        'id_evento', // ID do evento relacionado
        'status_intencao', // Status da intenção (ex: pendente, confirmada, cancelada)
        'id_usuario', // ID do usuário que expressou a intenção
    ];
}