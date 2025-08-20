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
        Schema::create('atividade', function (Blueprint $table) {
            $table->bigIncrements('id_atividade');
            $table->integer('likes')->default(0);
            $table->integer('score')->default(0);
            $table->enum('tipo_atividade', ['postagem', 'comentario', 'evento', 'participacao']);
            $table->unsignedBigInteger('id_gamificacao')->nullable();
            $table->foreign('id_gamificacao')->references('id_gameficacao')->on('gameficacao');
            $table->timestamps();
        });

        Schema::create('comentarios', function (Blueprint $table) {
            $table->bigIncrements('id_comentario');
            $table->text('descricao_comentario');
            $table->timestamp('data_comentario')->useCurrent();
            $table->unsignedBigInteger('id_usuario');
            $table->unsignedBigInteger('id_atividade')->nullable();
            $table->foreign('id_usuario')->references('id_usuario')->on('usuario');
            $table->foreign('id_atividade')->references('id_atividade')->on('atividade');
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
        
        Schema::dropIfExists('atividade');
        Schema::dropIfExists('comentarios');
    }
};
