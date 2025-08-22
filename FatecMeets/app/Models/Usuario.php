<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Usuario; // Importa o modelo Evento

class Usuario extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'usuario';
    protected $primaryKey = 'id_usuario';
    public $incrementing = true;
    protected $fillable = [
        'email',     // E-mail do usuário
        'password',  // Senha do usuário
        'imagem_usuario', // Imagem do usuário
        'status_conta', // Status da conta do usuário
    ];
    protected $hidden = [
        'password',        // Oculta a senha do usuário
        'remember_token',  // Oculta o token de "lembrar-me"
    ];
    protected $casts = [
        'imagem_usuario' => 'array',
        'email_verified_at' => 'datetime', // Converte o campo de verificação de e-mail para objeto DateTime
    ];
}