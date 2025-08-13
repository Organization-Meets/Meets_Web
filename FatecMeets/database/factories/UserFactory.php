<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 * 
 * Esta classe estende a Factory do Eloquent para o modelo User.
 */
class UserFactory extends Factory
{
    /**
     * Define o estado padrão do modelo.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // Retorna um array com os atributos padrão do usuário gerado
        return [
            // Gera um nome aleatório
            'name' => fake()->name(),
            // Gera um e-mail único e seguro
            'email' => fake()->unique()->safeEmail(),
            // Define a data de verificação do e-mail como agora
            'email_verified_at' => now(),
            // Define uma senha padrão criptografada
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // senha padrão
            // Gera um token de lembrança aleatório
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indica que o endereço de e-mail do modelo deve ser não verificado.
     *
     * @return static
     */
    public function unverified()
    {
        // Altera o estado para definir 'email_verified_at' como nulo
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}

