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
        Schema::create('evento', function (Blueprint $table) {
            $table->id('id_evento');
            $table->date('data_inicio_evento')->nullable();
            $table->date('data_final_evento')->nullable();
            $table->text('descricao')->nullable();
            $table->string('nome_evento', 255)->nullable();
            $table->unsignedBigInteger('id_usuario');
            $table->string('imagem_evento', 255)->nullable();
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
        Schema::dropIfExists('evento');
    }
};
