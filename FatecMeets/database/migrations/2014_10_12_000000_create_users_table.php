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
        // Cria a tabela 'users' no banco de dados
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Cria uma coluna 'id' como chave primária auto-incrementável
            $table->string('name'); // Cria uma coluna 'name' do tipo string para armazenar o nome do usuário
            $table->string('email')->unique(); // Cria uma coluna 'email' do tipo string e garante que seja única
            $table->timestamp('email_verified_at')->nullable(); // Cria uma coluna 'email_verified_at' para armazenar a data/hora de verificação do e-mail, podendo ser nula
            $table->string('password'); // Cria uma coluna 'password' do tipo string para armazenar a senha do usuário
            $table->rememberToken(); // Cria uma coluna 'remember_token' para autenticação "lembrar de mim"
            $table->timestamps(); // Cria as colunas 'created_at' e 'updated_at' para registrar datas de criação e atualização
        });
    }

    /**
     * Reverte as migrações.
     *
     * @return void
     */
    public function down()
    {
        // Remove a tabela 'users' do banco de dados
        Schema::dropIfExists('users');
    }
};
