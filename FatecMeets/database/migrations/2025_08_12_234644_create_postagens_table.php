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
        Schema::create('postagens', function (Blueprint $table) {
            $table->id('id_postagem');
            $table->text('descricao_postagem')->nullable();
            $table->date('data_postagem')->nullable();
            $table->string('titulo_postagem', 255)->nullable();
            $table->unsignedBigInteger('id_usuario');
            $table->string('imagem_postagem', 255)->nullable();
            $table->timestamps();

            $table->foreign('id_usuario')
                  ->references('id_usuario')
                  ->on('usuario')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('postagens');
    }
};
