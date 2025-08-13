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
        // Cria a tabela 'personal_access_tokens'
        Schema::create('personal_access_tokens', function (Blueprint $table) {
            $table->id(); // Chave primária auto-incrementável
            $table->morphs('tokenable'); // Cria colunas para relacionamento polimórfico (tokenable_id e tokenable_type)
            $table->string('name'); // Nome do token
            $table->string('token', 64)->unique(); // Token único com até 64 caracteres
            $table->text('abilities')->nullable(); // Permissões do token, pode ser nulo
            $table->timestamp('last_used_at')->nullable(); // Data/hora do último uso, pode ser nulo
            $table->timestamp('expires_at')->nullable(); // Data/hora de expiração, pode ser nulo
            $table->timestamps(); // Cria colunas 'created_at' e 'updated_at'
        });
    }

    /**
     * Reverte as migrações.
     *
     * @return void
     */
    public function down()
    {
        // Remove a tabela 'personal_access_tokens' caso exista
        Schema::dropIfExists('personal_access_tokens');
    }
};
