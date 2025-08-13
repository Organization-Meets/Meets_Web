<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Migration para criar a tabela de comentários
return new class extends Migration
{
    /**
     * Executa as migrações.
     *
     * @return void
     */
    public function up()
    {
        // Cria a tabela 'comentarios' com os campos necessários
        Schema::create('comentarios', function (Blueprint $table) {
            $table->id('id_comentario'); // Chave primária
            $table->dateTime('data_comentario')->nullable(); // Data do comentário
            $table->text('descricao_comentario')->nullable(); // Texto do comentário
            $table->unsignedBigInteger('id_usuario'); // Relacionamento com usuário
            $table->timestamps(); // Campos de controle de criação/atualização

            // Chave estrangeira para a tabela de usuários
            $table->foreign('id_usuario')
                  ->references('id_usuario')
                  ->on('usuario')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverte as migrações.
     *
     * @return void
     */
    public function down()
    {
        // Remove a tabela 'comentarios' caso exista
        Schema::dropIfExists('comentarios');
    }
};
