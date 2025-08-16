<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Tabela Chat
        Schema::create('chat', function (Blueprint $table) {
            $table->increments('id_chat');
            $table->integer('id_gameficacao')->unsigned();
            $table->foreign('id_gameficacao')->references('id_gameficacao')->on('gameficacao');
            $table->timestamps();
        });

        // Tabela Membros
        Schema::create('membros', function (Blueprint $table) {
            $table->increments('id_membros');
            $table->integer('id_chat')->unsigned();
            $table->integer('id_gameficacao')->unsigned();
            $table->tinyInteger('status_membro');
            $table->foreign('id_chat')->references('id_chat')->on('chat');
            $table->foreign('id_gameficacao')->references('id_gameficacao')->on('gameficacao');
            $table->timestamps();
        });

        // Tabela Conexao
        Schema::create('conexao', function (Blueprint $table) {
            $table->increments('id_conexao');
            $table->integer('id_gameficacao')->unsigned();
            $table->integer('id_gameficacao_conexao')->unsigned();
            $table->foreign('id_gameficacao')->references('id_gameficacao')->on('gameficacao');
            // Não há referência para id_gameficacao_conexao, pois pode ser auto-relacionamento
            $table->timestamps();
        });

        // Tabela Mensagens
        Schema::create('mensagens', function (Blueprint $table) {
            $table->increments('id_mensagens');
            $table->integer('id_gameficacao')->unsigned();
            $table->text('descricao_mensagens');
            $table->integer('id_chat')->unsigned();
            $table->foreign('id_gameficacao')->references('id_gameficacao')->on('gameficacao');
            $table->foreign('id_chat')->references('id_chat')->on('chat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mensagens');
        Schema::dropIfExists('conexao');
        Schema::dropIfExists('membros');
        Schema::dropIfExists('chat');
    }
};
