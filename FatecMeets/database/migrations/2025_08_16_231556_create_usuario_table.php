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
        Schema::create('usuario', function (Blueprint $table) {
            $table->increments('id_usuario');
            $table->string('senha', 255);
            $table->string('email', 255);
            $table->string('imagem_usuario', 255)->nullable();
            $table->integer('status_conta');
            $table->timestamps();
        });

        Schema::create('aluno', function (Blueprint $table) {
            $table->increments('id_aluno');
            $table->integer('id_usuario')->unsigned();
            $table->string('nome_aluno', 255);
            $table->integer('ra_aluno');
            $table->foreign('id_usuario')->references('id_usuario')->on('usuario');
            $table->timestamps();
        });

        Schema::create('academicos', function (Blueprint $table) {
            $table->increments('id_academico');
            $table->string('nome_academico', 255);
            $table->integer('ra_academico');
            $table->integer('id_usuario')->unsigned();
            $table->foreign('id_usuario')->references('id_usuario')->on('usuario');
            $table->timestamps();
        });

        Schema::create('evento', function (Blueprint $table) {
            $table->increments('id_evento');
            $table->dateTime('data_inicio_evento');
            $table->text('descricao');
            $table->string('nome_evento', 255);
            $table->integer('id_usuario')->unsigned();
            $table->dateTime('data_final_evento');
            $table->string('imagem_evento', 255)->nullable();
            $table->integer('id_atividade')->nullable();
            $table->string('categoria_evento', 100);
            $table->foreign('id_usuario')->references('id_usuario')->on('usuario');
            $table->timestamps();
        });

        Schema::create('instituicao', function (Blueprint $table) {
            $table->increments('id_instituicao');
            $table->string('nome_instituicao', 255);
            $table->string('codigo_institucional', 50);
            $table->timestamps();
        });

        Schema::create('endereco', function (Blueprint $table) {
            $table->increments('id_endereco');
            $table->string('numero', 10);
            $table->string('cep', 20);
            $table->timestamps();
        });

        Schema::create('telefone', function (Blueprint $table) {
            $table->increments('id_telefone');
            $table->string('numero_telefone', 15);
            $table->string('ddd', 3);
            $table->string('tipo_telefone', 20);
            $table->timestamps();
        });

        Schema::create('comentarios', function (Blueprint $table) {
            $table->increments('id_comentario');
            $table->dateTime('data_comentario');
            $table->text('descricao_comentario');
            $table->integer('id_usuario')->unsigned();
            $table->integer('id_atividade')->nullable();
            $table->foreign('id_usuario')->references('id_usuario')->on('usuario');
            $table->timestamps();
        });

        Schema::create('postagens', function (Blueprint $table) {
            $table->increments('id_postagem');
            $table->text('descricao_postagem');
            $table->integer('id_atividade')->nullable();
            $table->dateTime('data_postagem');
            $table->string('titulo_postagem', 255);
            $table->integer('id_usuario')->unsigned();
            $table->string('imagem_postagem', 255)->nullable();
            $table->foreign('id_usuario')->references('id_usuario')->on('usuario');
            $table->timestamps();
        });

        Schema::create('intencao', function (Blueprint $table) {
            $table->increments('id_intencao');
            $table->integer('id_evento')->unsigned();
            $table->integer('status_intencao');
            $table->integer('id_usuario')->unsigned();
            $table->foreign('id_evento')->references('id_evento')->on('evento');
            $table->foreign('id_usuario')->references('id_usuario')->on('usuario');
            $table->timestamps();
        });

        Schema::create('agenda', function (Blueprint $table) {
            $table->increments('id_agenda');
            $table->dateTime('data');
            $table->integer('id_usuario')->unsigned();
            $table->text('descricao');
            $table->foreign('id_usuario')->references('id_usuario')->on('usuario');
            $table->timestamps();
        });

        Schema::create('gameficacao', function (Blueprint $table) {
            $table->increments('id_gameficacao');
            $table->integer('score_total');
            $table->string('nickname', 100);
            $table->integer('id_usuario')->unsigned();
            $table->foreign('id_usuario')->references('id_usuario')->on('usuario');
            $table->timestamps();
        });

        Schema::create('atividade', function (Blueprint $table) {
            $table->increments('id_atividade');
            $table->integer('likes');
            $table->integer('score');
            $table->string('tipo_atividade', 50);
            $table->integer('id_gameficacao')->unsigned();
            $table->foreign('id_gameficacao')->references('id_gameficacao')->on('gameficacao');
            $table->timestamps();
        });

        Schema::create('adicionais', function (Blueprint $table) {
            $table->increments('id_adicionais');
            $table->integer('id_usuario')->unsigned();
            $table->integer('id_telefone')->unsigned();
            $table->integer('id_endereco')->unsigned();
            $table->integer('id_instituicao')->unsigned();
            $table->foreign('id_usuario')->references('id_usuario')->on('usuario');
            $table->foreign('id_telefone')->references('id_telefone')->on('telefone');
            $table->foreign('id_endereco')->references('id_endereco')->on('endereco');
            $table->foreign('id_instituicao')->references('id_instituicao')->on('instituicao');
            $table->timestamps();
        });

        Schema::create('redes', function (Blueprint $table) {
            $table->increments('id_redes');
            $table->integer('id_adicionais')->unsigned();
            $table->string('url_redes', 255);
            $table->foreign('id_adicionais')->references('id_adicionais')->on('adicionais');
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
        Schema::dropIfExists('redes');
        Schema::dropIfExists('adicionais');
        Schema::dropIfExists('atividade');
        Schema::dropIfExists('gameficacao');
        Schema::dropIfExists('agenda');
        Schema::dropIfExists('intencao');
        Schema::dropIfExists('postagens');
        Schema::dropIfExists('comentarios');
        Schema::dropIfExists('telefone');
        Schema::dropIfExists('endereco');
        Schema::dropIfExists('instituicao');
        Schema::dropIfExists('evento');
        Schema::dropIfExists('academicos');
        Schema::dropIfExists('aluno');
        Schema::dropIfExists('usuario');
    }
};
