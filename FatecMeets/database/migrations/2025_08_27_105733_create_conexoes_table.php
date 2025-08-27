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
        Schema::create('conexoes', function (Blueprint $table) {
            $table->bigIncrements('id_conexao');
            $table->unsignedBigInteger('id_usuario_origem');
            $table->unsignedBigInteger('id_usuario_destino');
            $table->enum('status', ['pendente', 'aceito', 'recusado'])->default('pendente');
            $table->timestamps();

            $table->foreign('id_usuario_origem')->references('id_usuario')->on('usuarios')->onDelete('cascade');
            $table->foreign('id_usuario_destino')->references('id_usuario')->on('usuarios')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conexoes');
    }
};
