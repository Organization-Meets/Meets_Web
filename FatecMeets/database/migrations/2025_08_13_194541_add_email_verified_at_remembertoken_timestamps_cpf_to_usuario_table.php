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
        // Modifica a tabela 'usuario'
        Schema::table('usuario', function (Blueprint $table) {
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
        });
    }

    /**
     * Reverte as migrações.
     *
     * @return void
     */
    public function down()
    {
        // Reverte as alterações feitas na tabela 'usuario'
        Schema::table('usuario', function (Blueprint $table) {
            // Adicione aqui as instruções para desfazer as alterações feitas no método up
        });
    }
};
