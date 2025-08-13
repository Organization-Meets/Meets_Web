<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Migration para criar a tabela de postagens
return new class extends Migration
{
    /**
     * Executa as migrações.
     *
     * @return void
     */
    public function up()
    {
        // Cria a tabela 'postagens' com os campos necessários
        Schema::create('postagens', function (Blueprint $table) {
            $table->id('id_postagem'); // Chave primária
            $table->text('descricao_postagem')->nullable(); // Texto da postagem
            $table->date('data_postagem')->nullable(); // Data da postagem
            $table->string('titulo_postagem', 255)->nullable(); // Título da postagem
            $table->unsignedBigInteger('id_usuario'); // Relacionamento com usuário
            $table->string('imagem_postagem', 255)->nullable(); // Caminho da imagem
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
        // Remove a tabela 'postagens' caso exista
        Schema::dropIfExists('postagens');
    }
};
