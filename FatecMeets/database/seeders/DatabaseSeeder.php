<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents; // Importação opcional para eventos sem modelo
use Illuminate\Database\Seeder;

// Classe responsável por semear (popular) o banco de dados da aplicação
class DatabaseSeeder extends Seeder
{
    /**
     * Semeia o banco de dados da aplicação.
     *
     * @return void
     */
    public function run()
    {
        // Cria 10 usuários fictícios usando a factory do modelo User
        // \App\Models\User::factory(10)->create();

        // Cria um usuário fictício com nome e e-mail específicos
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}

