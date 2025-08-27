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
        Schema::create('instituicoes', function (Blueprint $table) {
            $table->id('id_instituicao');
            $table->unsignedBigInteger('id_administrador');
            $table->unsignedBigInteger('id_telefone'); 
            $table->unsignedBigInteger('id_endereco'); 
            $table->string('nome_instituicao', 255);
            $table->string('codigo_institucional', 50)->unique();

            $table->foreign('id_administrador')->references('id_administrador')->on('administradores')->onDelete('cascade');
            $table->foreign('id_telefone')->references('id_telefone')->on('telefones')->onDelete('cascade');
            $table->foreign('id_endereco')->references('id_endereco')->on('enderecos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('instituicoes');
    }
};
