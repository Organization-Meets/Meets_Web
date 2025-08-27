<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // =====================
        // TABELA USUARIOS
        // =====================
        Schema::create('usuarios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('email_verification_token', 10)->nullable();
            $table->json('imagem')->nullable();
            $table->enum('status', ['ativo','inativo','suspenso'])->default('ativo');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        // =====================
        // TABELA ADMINISTRADORES
        // =====================
        Schema::create('administradores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('usuario_id');
            $table->string('nome');
            $table->string('ra', 20)->unique();
            $table->timestamps();

            $table->foreign('usuario_id')->references('id')->on('usuarios')->onDelete('cascade');
        });

        // =====================
        // TABELA CONEXOES
        // =====================
        Schema::create('conexoes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('usuario_origem_id');
            $table->unsignedBigInteger('usuario_destino_id');
            $table->enum('status', ['pendente', 'aceito', 'recusado', 'bloqueado'])->default('pendente');
            $table->timestamps();

            $table->foreign('usuario_origem_id')->references('id')->on('usuarios')->onDelete('cascade');
            $table->foreign('usuario_destino_id')->references('id')->on('usuarios')->onDelete('cascade');
            $table->unique(['usuario_origem_id', 'usuario_destino_id']);
        });

        // =====================
        // TABELA GAMIFICACOES
        // =====================
        Schema::create('gamificacoes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('score_total')->default(0);
            $table->string('nickname', 100)->unique()->nullable();
            $table->unsignedBigInteger('usuario_id');
            $table->timestamps();

            $table->foreign('usuario_id')->references('id')->on('usuarios');
        });

        // =====================
        // TABELA ALUNOS
        // =====================
        Schema::create('alunos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('usuario_id');
            $table->string('nome');
            $table->string('ra', 20)->unique();
            $table->timestamps();

            $table->foreign('usuario_id')->references('id')->on('usuarios')->onDelete('cascade');
        });

        // =====================
        // TABELA ACADEMICOS
        // =====================
        Schema::create('academicos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('usuario_id');
            $table->string('nome');
            $table->string('ra', 20)->unique();
            $table->timestamps();

            $table->foreign('usuario_id')->references('id')->on('usuarios')->onDelete('cascade');
        });

        // =====================
        // TABELA ATIVIDADES
        // =====================
        Schema::create('atividades', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('likes')->default(0);
            $table->enum('tipo', ['postagem','comentario','evento','participacao']);
            $table->timestamps();
        });

        // =====================
        // TABELA COMENTARIOS
        // =====================
        Schema::create('comentarios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('descricao');
            $table->timestamp('data')->useCurrent();
            $table->unsignedBigInteger('usuario_id');
            $table->unsignedBigInteger('atividade_id')->nullable();
            $table->timestamps();

            $table->foreign('usuario_id')->references('id')->on('usuarios');
            $table->foreign('atividade_id')->references('id')->on('atividades');
        });

        // =====================
        // TABELA TELEFONES
        // =====================
        Schema::create('telefones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('numero', 15);
            $table->string('ddd', 3);
            $table->enum('tipo', ['celular','residencial','comercial'])->default('celular');
            $table->timestamps();
        });

        // =====================
        // TABELA ENDERECOS
        // =====================
        Schema::create('enderecos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('numero', 10)->nullable();
            $table->string('cep', 10);
            $table->timestamps();
        });

        // =====================
        // TABELA COMPLEMENTOS
        // =====================
        Schema::create('complementos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('endereco_id');
            $table->string('nome');
            $table->timestamps();

            $table->foreign('endereco_id')->references('id')->on('enderecos')->onDelete('cascade');
        });

        // =====================
        // TABELA LUGARES
        // =====================
        Schema::create('lugares', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('endereco_id');
            $table->string('nome');
            $table->unsignedBigInteger('administrador_id')->nullable();
            $table->timestamps();

            $table->foreign('endereco_id')->references('id')->on('enderecos')->onDelete('cascade');
            $table->foreign('administrador_id')->references('id')->on('administradores')->onDelete('cascade');
        });

        // =====================
        // TABELA INSTITUICOES
        // =====================
        Schema::create('instituicoes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('administrador_id');
            $table->string('nome');
            $table->string('codigo', 50)->unique()->nullable();
            $table->unsignedBigInteger('telefone_id');
            $table->unsignedBigInteger('endereco_id');
            $table->timestamps();

            $table->foreign('administrador_id')->references('id')->on('administradores')->onDelete('cascade');
            $table->foreign('endereco_id')->references('id')->on('enderecos')->onDelete('cascade');
            $table->foreign('telefone_id')->references('id')->on('telefones')->onDelete('cascade');
        });

        // =====================
        // TABELA ADICIONAIS
        // =====================
        Schema::create('adicionais', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('usuario_id');
            $table->unsignedBigInteger('telefone_id')->nullable();
            $table->unsignedBigInteger('endereco_id')->nullable();
            $table->unsignedBigInteger('instituicao_id')->nullable();
            $table->timestamps();

            $table->foreign('usuario_id')->references('id')->on('usuarios');
            $table->foreign('telefone_id')->references('id')->on('telefones');
            $table->foreign('endereco_id')->references('id')->on('enderecos');
            $table->foreign('instituicao_id')->references('id')->on('instituicoes');
        });

        // =====================
        // TABELA REDES
        // =====================
        Schema::create('redes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('adicional_id');
            $table->enum('tipo', ['instagram','linkedin','github','twitter','facebook','outro']);
            $table->string('url', 500);
            $table->timestamps();

            $table->foreign('adicional_id')->references('id')->on('adicionais');
        });

        // =====================
        // TABELA POSTAGENS
        // =====================
        Schema::create('postagens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('titulo');
            $table->text('descricao');
            $table->json('imagem')->nullable();
            $table->timestamp('data')->useCurrent();
            $table->unsignedBigInteger('usuario_id');
            $table->unsignedBigInteger('atividade_id')->nullable();
            $table->timestamps();

            $table->foreign('usuario_id')->references('id')->on('usuarios');
            $table->foreign('atividade_id')->references('id')->on('atividades');
        });

        // =====================
        // TABELA EVENTOS
        // =====================
        Schema::create('eventos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome');
            $table->json('imagem')->nullable();
            $table->text('descricao');
            $table->date('data_inicio');
            $table->date('data_final');
            $table->unsignedBigInteger('complemento_id');
            $table->unsignedBigInteger('usuario_id');
            $table->unsignedBigInteger('atividade_id')->nullable();
            $table->timestamps();

            $table->foreign('usuario_id')->references('id')->on('usuarios');
            $table->foreign('atividade_id')->references('id')->on('atividades');
            $table->foreign('complemento_id')->references('id')->on('complementos');
        });

        // =====================
        // TABELA CHATS
        // =====================
        Schema::create('chats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome');
            $table->enum('tipo', ['privado','grupo'])->default('privado');
            $table->unsignedBigInteger('usuario_id');
            $table->timestamps();

            $table->foreign('usuario_id')->references('id')->on('usuarios');
        });

        // =====================
        // TABELA MEMBROS
        // =====================
        Schema::create('membros', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('chat_id');
            $table->unsignedBigInteger('usuario_id');
            $table->enum('role', ['membro','admin'])->default('membro');
            $table->timestamps();

            $table->foreign('chat_id')->references('id')->on('chats');
            $table->foreign('usuario_id')->references('id')->on('usuarios');
        });

        // =====================
        // TABELA MENSAGENS
        // =====================
        Schema::create('mensagens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('conteudo');
            $table->unsignedBigInteger('chat_id');
            $table->unsignedBigInteger('usuario_id');
            $table->timestamps();

            $table->foreign('chat_id')->references('id')->on('chats');
            $table->foreign('usuario_id')->references('id')->on('usuarios');
        });

        // =====================
        // TABELA ARQUIVOS_MORTOS
        // =====================
        Schema::create('arquivos_mortos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('usuario_id');
            $table->string('tabela_origem', 100);
            $table->bigInteger('registro_origem_id');
            $table->text('motivo_exclusao')->nullable();
            $table->json('dados')->nullable();
            $table->timestamps();

            $table->foreign('usuario_id')->references('id')->on('usuarios')->onDelete('cascade');
        });

        // =====================
        // TABELA DENUNCIAS
        // =====================
        Schema::create('denuncias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('usuario_id');
            $table->unsignedBigInteger('arquivo_morto_id');
            $table->unsignedBigInteger('administrador_id')->nullable();
            $table->string('tipo', 100);
            $table->text('descricao');
            $table->enum('status', ['aberta','em_analise','resolvida','arquivada'])->default('aberta');
            $table->timestamps();

            $table->foreign('usuario_id')->references('id')->on('usuarios')->onDelete('cascade');
            $table->foreign('administrador_id')->references('id')->on('administradores')->onDelete('set null');
            $table->foreign('arquivo_morto_id')->references('id')->on('arquivos_mortos')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('denuncias');
        Schema::dropIfExists('arquivos_mortos');
        Schema::dropIfExists('mensagens');
        Schema::dropIfExists('membros');
        Schema::dropIfExists('chats');
        Schema::dropIfExists('eventos');
        Schema::dropIfExists('postagens');
        Schema::dropIfExists('redes');
        Schema::dropIfExists('adicionais');
        Schema::dropIfExists('instituicoes');
        Schema::dropIfExists('lugares');
        Schema::dropIfExists('complementos');
        Schema::dropIfExists('enderecos');
        Schema::dropIfExists('telefones');
        Schema::dropIfExists('comentarios');
        Schema::dropIfExists('atividades');
        Schema::dropIfExists('academicos');
        Schema::dropIfExists('alunos');
        Schema::dropIfExists('gamificacoes');
        Schema::dropIfExists('conexoes');
        Schema::dropIfExists('administradores');
        Schema::dropIfExists('usuarios');
    }
};
