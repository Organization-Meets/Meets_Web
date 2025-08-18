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
            $table->bigIncrements('id_usuario');
            $table->string('email', 255)->unique();
            $table->string('senha', 255);
            $table->string('imagem_usuario', 500)->nullable();
            $table->enum('status_conta', ['ativo', 'inativo', 'suspenso'])->default('ativo');
            $table->timestamps();
        });

        Schema::create('telefone', function (Blueprint $table) {
            $table->bigIncrements('id_telefone');
            $table->string('numero_telefone', 15);
            $table->string('ddd', 3);
            $table->enum('tipo_telefone', ['celular', 'residencial', 'comercial'])->default('celular');
        });

        Schema::create('endereco', function (Blueprint $table) {
            $table->bigIncrements('id_endereco');
            $table->string('numero', 10)->nullable();
            $table->string('cep', 10);
        });

        Schema::create('instituicao', function (Blueprint $table) {
            $table->bigIncrements('id_instituicao');
            $table->string('nome_instituicao', 255);
            $table->string('codigo_institucional', 50)->unique()->nullable();
        });

        Schema::create('administradores', function (Blueprint $table) {
            $table->bigIncrements('id_administrador');
            $table->unsignedBigInteger('id_usuario');
            $table->string('nome_administrador', 255);
            $table->foreign('id_usuario')->references('id_usuario')->on('usuario');
        });

        Schema::create('aluno', function (Blueprint $table) {
            $table->bigIncrements('id_aluno');
            $table->unsignedBigInteger('id_usuario');
            $table->string('nome_aluno', 255);
            $table->string('ra_aluno', 20)->unique();
            $table->foreign('id_usuario')->references('id_usuario')->on('usuario');
        });

        Schema::create('academicos', function (Blueprint $table) {
            $table->bigIncrements('id_academicos');
            $table->unsignedBigInteger('id_usuario');
            $table->string('nome_academicos', 255);
            $table->string('ra_academicos', 20)->unique();
            $table->foreign('id_usuario')->references('id_usuario')->on('usuario');
        });

        Schema::create('logradouro', function (Blueprint $table) {
            $table->bigIncrements('id_logradouro');
            $table->unsignedBigInteger('id_endereco');
            $table->string('nome_logradouro', 255);
            $table->foreign('id_endereco')->references('id_endereco')->on('endereco');
        });

        Schema::create('lugares', function (Blueprint $table) {
            $table->bigIncrements('id_lugar');
            $table->unsignedBigInteger('id_endereco');
            $table->string('nome_lugares', 255);
            $table->unsignedBigInteger('id_administrador')->nullable();
            $table->foreign('id_endereco')->references('id_endereco')->on('endereco');
            $table->foreign('id_administrador')->references('id_administrador')->on('administradores');
        });

        Schema::create('gameficacao', function (Blueprint $table) {
            $table->bigIncrements('id_gameficacao');
            $table->integer('score_total')->default(0);
            $table->string('nickname', 100)->unique()->nullable();
            $table->unsignedBigInteger('id_usuario');
            $table->foreign('id_usuario')->references('id_usuario')->on('usuario');
        });

        Schema::create('atividade', function (Blueprint $table) {
            $table->bigIncrements('id_atividade');
            $table->integer('likes')->default(0);
            $table->integer('score')->default(0);
            $table->enum('tipo_atividade', ['postagem', 'comentario', 'evento', 'participacao']);
            $table->unsignedBigInteger('id_gamificacao')->nullable();
            $table->foreign('id_gamificacao')->references('id_gameficacao')->on('gameficacao');
        });

        Schema::create('evento', function (Blueprint $table) {
            $table->bigIncrements('id_evento');
            $table->string('nome_evento', 255);
            $table->text('descricao')->nullable();
            $table->dateTime('data_inicio_evento');
            $table->dateTime('data_final_evento')->nullable();
            $table->string('imagem_evento', 500)->nullable();
            $table->string('categoria_evento', 100)->nullable();
            $table->unsignedBigInteger('id_usuario');
            $table->unsignedBigInteger('id_atividade')->nullable();
            $table->unsignedBigInteger('id_lugares')->nullable();
            $table->unsignedBigInteger('id_logradouro')->nullable();
            $table->foreign('id_usuario')->references('id_usuario')->on('usuario');
            $table->foreign('id_atividade')->references('id_atividade')->on('atividade');
            $table->foreign('id_lugares')->references('id_lugar')->on('lugares');
            $table->foreign('id_logradouro')->references('id_logradouro')->on('logradouro');
        });

        Schema::create('postagens', function (Blueprint $table) {
            $table->bigIncrements('id_postagem');
            $table->string('titulo_postagem', 255);
            $table->text('descricao_postagem')->nullable();
            $table->string('imagem_postagem', 500)->nullable();
            $table->timestamp('data_postagem')->useCurrent();
            $table->unsignedBigInteger('id_usuario');
            $table->unsignedBigInteger('id_atividade')->nullable();
            $table->foreign('id_usuario')->references('id_usuario')->on('usuario');
            $table->foreign('id_atividade')->references('id_atividade')->on('atividade');
        });

        Schema::create('comentarios', function (Blueprint $table) {
            $table->bigIncrements('id_comentario');
            $table->text('descricao_comentario');
            $table->timestamp('data_comentario')->useCurrent();
            $table->unsignedBigInteger('id_usuario');
            $table->unsignedBigInteger('id_atividade')->nullable();
            $table->foreign('id_usuario')->references('id_usuario')->on('usuario');
            $table->foreign('id_atividade')->references('id_atividade')->on('atividade');
        });

        Schema::create('intencao', function (Blueprint $table) {
            $table->bigIncrements('id_intencao');
            $table->unsignedBigInteger('id_evento');
            $table->unsignedBigInteger('id_usuario');
            $table->enum('status_intencao', ['interessado', 'participando', 'cancelado'])->default('interessado');
            $table->foreign('id_evento')->references('id_evento')->on('evento');
            $table->foreign('id_usuario')->references('id_usuario')->on('usuario');
            $table->unique(['id_usuario', 'id_evento']);
        });

        Schema::create('agenda', function (Blueprint $table) {
            $table->bigIncrements('id_agenda');
            $table->unsignedBigInteger('id_usuario');
            $table->date('data_agenda');
            $table->text('descricao')->nullable();
            $table->unsignedBigInteger('id_evento')->nullable();
            $table->foreign('id_usuario')->references('id_usuario')->on('usuario');
            $table->foreign('id_evento')->references('id_evento')->on('evento');
        });

        Schema::create('adicionais', function (Blueprint $table) {
            $table->bigIncrements('id_adicionais');
            $table->unsignedBigInteger('id_usuario');
            $table->unsignedBigInteger('id_telefone')->nullable();
            $table->unsignedBigInteger('id_endereco')->nullable();
            $table->unsignedBigInteger('id_instituicao')->nullable();
            $table->foreign('id_usuario')->references('id_usuario')->on('usuario');
            $table->foreign('id_telefone')->references('id_telefone')->on('telefone');
            $table->foreign('id_endereco')->references('id_endereco')->on('endereco');
            $table->foreign('id_instituicao')->references('id_instituicao')->on('instituicao');
        });

        Schema::create('redes', function (Blueprint $table) {
            $table->bigIncrements('id_redes');
            $table->unsignedBigInteger('id_adicionais');
            $table->enum('tipo_rede', ['instagram', 'linkedin', 'github', 'twitter', 'facebook', 'outro']);
            $table->string('url_redes', 500);
            $table->foreign('id_adicionais')->references('id_adicionais')->on('adicionais');
        });

        Schema::create('chat', function (Blueprint $table) {
            $table->bigIncrements('id_chat');
            $table->string('nome_chat', 255)->nullable();
            $table->enum('tipo_chat', ['privado', 'grupo'])->default('privado');
        });

        Schema::create('membros', function (Blueprint $table) {
            $table->bigIncrements('id_membros');
            $table->unsignedBigInteger('id_chat');
            $table->unsignedBigInteger('id_gameficacao');
            $table->enum('status_membro', ['ativo', 'saiu', 'removido'])->default('ativo');
            $table->foreign('id_chat')->references('id_chat')->on('chat');
            $table->foreign('id_gameficacao')->references('id_gameficacao')->on('gameficacao');
            $table->unique(['id_chat', 'id_gameficacao']);
        });

        Schema::create('mensagens', function (Blueprint $table) {
            $table->bigIncrements('id_mensagens');
            $table->unsignedBigInteger('id_chat');
            $table->unsignedBigInteger('id_gameficacao');
            $table->text('descricao_mensagens');
            $table->timestamp('data_mensagem')->useCurrent();
            $table->foreign('id_chat')->references('id_chat')->on('chat');
            $table->foreign('id_gameficacao')->references('id_gameficacao')->on('gameficacao');
        });

        Schema::create('conexao', function (Blueprint $table) {
            $table->bigIncrements('id_conexao');
            $table->unsignedBigInteger('id_gameficacao');
            $table->unsignedBigInteger('id_gameficacao_conexao');
            $table->enum('status_conexao', ['pendente', 'aceita', 'rejeitada'])->default('pendente');
            $table->foreign('id_gameficacao')->references('id_gameficacao')->on('gameficacao');
            $table->foreign('id_gameficacao_conexao')->references('id_gameficacao')->on('gameficacao');
            $table->unique(['id_gameficacao', 'id_gameficacao_conexao']);
        });

        Schema::create('lixo', function (Blueprint $table) {
            $table->bigIncrements('id_lixo');
            $table->unsignedBigInteger('id_usuario');
            $table->string('tabela_origem', 100);
            $table->integer('id_registro_origem');
            $table->text('motivo_exclusao')->nullable();
            $table->json('dados_tabela')->nullable();
            $table->foreign('id_usuario')->references('id_usuario')->on('usuario');
        });

        Schema::create('usuario_denunciado', function (Blueprint $table) {
            $table->bigIncrements('id_usuario_denunciado');
            $table->unsignedBigInteger('id_usuario');
            $table->unsignedBigInteger('id_administrador')->nullable();
            $table->unsignedBigInteger('id_lixo')->nullable();
            $table->text('motivo_denuncia')->nullable();
            $table->enum('status_denuncia', ['pendente', 'analisando', 'resolvida', 'rejeitada'])->default('pendente');
            $table->foreign('id_usuario')->references('id_usuario')->on('usuario');
            $table->foreign('id_administrador')->references('id_administrador')->on('administradores');
            $table->foreign('id_lixo')->references('id_lixo')->on('lixo');
        });

        Schema::create('mensagens_denunciado', function (Blueprint $table) {
            $table->bigIncrements('id_mensagens_denunciado');
            $table->unsignedBigInteger('id_mensagens');
            $table->unsignedBigInteger('id_administrador')->nullable();
            $table->unsignedBigInteger('id_lixo')->nullable();
            $table->text('motivo_denuncia')->nullable();
            $table->enum('status_denuncia', ['pendente', 'analisando', 'resolvida', 'rejeitada'])->default('pendente');
            $table->foreign('id_mensagens')->references('id_mensagens')->on('mensagens');
            $table->foreign('id_administrador')->references('id_administrador')->on('administradores');
            $table->foreign('id_lixo')->references('id_lixo')->on('lixo');
        });

        Schema::create('chat_denunciado', function (Blueprint $table) {
            $table->bigIncrements('id_chat_denunciado');
            $table->unsignedBigInteger('id_chat');
            $table->unsignedBigInteger('id_administrador')->nullable();
            $table->unsignedBigInteger('id_lixo')->nullable();
            $table->text('motivo_denuncia')->nullable();
            $table->enum('status_denuncia', ['pendente', 'analisando', 'resolvida', 'rejeitada'])->default('pendente');
            $table->foreign('id_chat')->references('id_chat')->on('chat');
            $table->foreign('id_administrador')->references('id_administrador')->on('administradores');
            $table->foreign('id_lixo')->references('id_lixo')->on('lixo');
        });

        Schema::create('postagens_denunciado', function (Blueprint $table) {
            $table->bigIncrements('id_postagens_denunciado');
            $table->unsignedBigInteger('id_postagem');
            $table->unsignedBigInteger('id_administrador')->nullable();
            $table->unsignedBigInteger('id_lixo')->nullable();
            $table->text('motivo_denuncia')->nullable();
            $table->enum('status_denuncia', ['pendente', 'analisando', 'resolvida', 'rejeitada'])->default('pendente');
            $table->foreign('id_postagem')->references('id_postagem')->on('postagens');
            $table->foreign('id_administrador')->references('id_administrador')->on('administradores');
            $table->foreign('id_lixo')->references('id_lixo')->on('lixo');
        });

        Schema::create('gameficacao_denunciado', function (Blueprint $table) {
            $table->bigIncrements('id_gameficacao_denunciado');
            $table->unsignedBigInteger('id_gameficacao');
            $table->unsignedBigInteger('id_administrador')->nullable();
            $table->unsignedBigInteger('id_lixo')->nullable();
            $table->text('motivo_denuncia')->nullable();
            $table->enum('status_denuncia', ['pendente', 'analisando', 'resolvida', 'rejeitada'])->default('pendente');
            $table->foreign('id_gameficacao')->references('id_gameficacao')->on('gameficacao');
            $table->foreign('id_administrador')->references('id_administrador')->on('administradores');
            $table->foreign('id_lixo')->references('id_lixo')->on('lixo');
        });

        Schema::create('comentarios_denunciado', function (Blueprint $table) {
            $table->bigIncrements('id_comentarios_denunciado');
            $table->unsignedBigInteger('id_comentario');
            $table->unsignedBigInteger('id_administrador')->nullable();
            $table->unsignedBigInteger('id_lixo')->nullable();
            $table->text('motivo_denuncia')->nullable();
            $table->enum('status_denuncia', ['pendente', 'analisando', 'resolvida', 'rejeitada'])->default('pendente');
            $table->foreign('id_comentario')->references('id_comentario')->on('comentarios');
            $table->foreign('id_administrador')->references('id_administrador')->on('administradores');
            $table->foreign('id_lixo')->references('id_lixo')->on('lixo');
        });

        Schema::create('evento_denunciado', function (Blueprint $table) {
            $table->bigIncrements('id_evento_denunciado');
            $table->unsignedBigInteger('id_evento');
            $table->unsignedBigInteger('id_administrador')->nullable();
            $table->unsignedBigInteger('id_lixo')->nullable();
            $table->text('motivo_denuncia')->nullable();
            $table->enum('status_denuncia', ['pendente', 'analisando', 'resolvida', 'rejeitada'])->default('pendente');
            $table->foreign('id_evento')->references('id_evento')->on('evento');
            $table->foreign('id_administrador')->references('id_administrador')->on('administradores');
            $table->foreign('id_lixo')->references('id_lixo')->on('lixo');
        });

        Schema::create('comentario_evento', function (Blueprint $table) {
            $table->bigIncrements('id_comentario_evento');
            $table->unsignedBigInteger('id_evento');
            $table->unsignedBigInteger('id_comentario');
            $table->timestamp('created_at')->useCurrent();
            $table->foreign('id_evento')->references('id_evento')->on('evento');
            $table->foreign('id_comentario')->references('id_comentario')->on('comentarios');
            $table->unique(['id_evento', 'id_comentario']);
        });

        Schema::create('comentario_postagem', function (Blueprint $table) {
            $table->bigIncrements('id_comentario_postagem');
            $table->unsignedBigInteger('id_postagem');
            $table->unsignedBigInteger('id_comentario');
            $table->timestamp('created_at')->useCurrent();
            $table->foreign('id_postagem')->references('id_postagem')->on('postagens');
            $table->foreign('id_comentario')->references('id_comentario')->on('comentarios');
            $table->unique(['id_postagem', 'id_comentario']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comentario_postagem');
        Schema::dropIfExists('comentario_evento');
        Schema::dropIfExists('evento_denunciado');
        Schema::dropIfExists('comentarios_denunciado');
        Schema::dropIfExists('gameficacao_denunciado');
        Schema::dropIfExists('postagens_denunciado');
        Schema::dropIfExists('chat_denunciado');
        Schema::dropIfExists('mensagens_denunciado');
        Schema::dropIfExists('usuario_denunciado');
        Schema::dropIfExists('lixo');
        Schema::dropIfExists('conexao');
        Schema::dropIfExists('mensagens');
        Schema::dropIfExists('membros');
        Schema::dropIfExists('chat');
        Schema::dropIfExists('redes');
        Schema::dropIfExists('adicionais');
        Schema::dropIfExists('agenda');
        Schema::dropIfExists('intencao');
        Schema::dropIfExists('comentarios');
        Schema::dropIfExists('postagens');
        Schema::dropIfExists('evento');
        Schema::dropIfExists('atividade');
        Schema::dropIfExists('gameficacao');
        Schema::dropIfExists('lugares');
        Schema::dropIfExists('logradouro');
        Schema::dropIfExists('academicos');
        Schema::dropIfExists('aluno');
        Schema::dropIfExists('administradores');
        Schema::dropIfExists('instituicao');
        Schema::dropIfExists('endereco');
        Schema::dropIfExists('telefone');
        Schema::dropIfExists('usuario');
    }
};
