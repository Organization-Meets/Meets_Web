<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Retorna uma nova classe anônima que estende Migration
return new class extends Migration
{
    /**
     * Executa as migrações.
     *
     * @return void
     */
    public function up()
    {
        // Cria a tabela 'password_resets' no banco de dados
        Schema::create('password_resets', function (Blueprint $table) {
            // Define a coluna 'email' como chave primária da tabela
            $table->string('email')->primary();
            // Adiciona a coluna 'token' para armazenar o token de redefinição de senha
            $table->string('token');
            // Adiciona a coluna 'created_at' para registrar a data/hora de criação do reset, podendo ser nula
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverte as migrações.
     *
     * @return void
     */
    public function down()
    {
        // Remove a tabela 'password_resets' do banco de dados
        Schema::dropIfExists('password_resets');
    }
};
