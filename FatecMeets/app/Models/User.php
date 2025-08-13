<?php

namespace App\Models;

// Importa funcionalidades relacionadas à autenticação, notificações e tokens de API
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

// Modelo que representa o usuário autenticado no sistema
class User extends Authenticatable
{
    // Usa traits para adicionar funcionalidades de tokens de API, fábrica de modelos e notificações
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Os atributos que podem ser atribuídos em massa.
     * Define quais campos podem ser preenchidos via métodos como create() ou update().
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',      // Nome do usuário
        'email',     // E-mail do usuário
        'password',  // Senha do usuário
    ];

    /**
     * Os atributos que devem ser ocultados na serialização.
     * Estes campos não serão exibidos quando o modelo for convertido em array ou JSON.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',        // Oculta a senha do usuário
        'remember_token',  // Oculta o token de "lembrar-me"
    ];

    /**
     * Os atributos que devem ser convertidos para outros tipos.
     * Define conversões automáticas de tipos para os campos especificados.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime', // Converte o campo de verificação de e-mail para objeto DateTime
    ];
}

