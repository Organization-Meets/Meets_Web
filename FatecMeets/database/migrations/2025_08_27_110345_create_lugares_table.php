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
        Schema::create('lugares', function (Blueprint $table) {
            $table->bigIncrements('id_lugar');
            $table->unsignedBigInteger('id_endereco'); 
            $table->string('nome_lugar', 255);         
            $table->unsignedBigInteger('id_administrador');
            $table->timestamps();

            $table->foreign('id_endereco')->references('id_endereco')->on('enderecos')->onDelete('cascade'); 
            $table->foreign('id_administrador')->references('id')->on('administradores')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lugares');
    }
};
