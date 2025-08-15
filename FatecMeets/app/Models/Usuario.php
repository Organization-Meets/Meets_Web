<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Evento; // Importa o modelo Evento

class Usuario extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'usuario';
    protected $primaryKey = 'id_usuario';
    public $incrementing = true;
    protected $fillable = [
        'email',     // E-mail do usuário
        'senha',  // Senha do usuário
        'imagem_usuario', // Imagem do usuário
        'status_conta', // Status da conta do usuário
    ];
    protected $hidden = [
        'senha',        // Oculta a senha do usuário
        'remember_token',  // Oculta o token de "lembrar-me"
    ];
    protected $casts = [
        'email_verified_at' => 'datetime', // Converte o campo de verificação de e-mail para objeto DateTime
    ];

    public function eventos()
    {
        return $this->hasMany(Evento::class, 'id_usuario', 'id_usuario');
    }
}
