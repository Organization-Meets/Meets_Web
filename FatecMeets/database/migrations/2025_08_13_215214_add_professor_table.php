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
        Schema::table('evento', function (Blueprint $table) {
            $table->unsignedBigInteger('id_endereco');
            
            $table->foreign('id_endereco')
                  ->references('id_endereco')
                  ->on('endereco')
                  ->onDelete('cascade');
        });
        Schema::table('instituicao', function (Blueprint $table) {
            $table->unsignedBigInteger('id_endereco');
            
            $table->foreign('id_endereco')
                  ->references('id_endereco')
                  ->on('endereco')
                  ->onDelete('cascade');
        });
        Schema::table('usuario', function (Blueprint $table) {
            $table->unsignedBigInteger('id_endereco');
            
            $table->foreign('id_endereco')
                  ->references('id_endereco')
                  ->on('endereco')
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
        Schema::table('evento', function (Blueprint $table) {
            //
        });
        Schema::table('instituicao', function (Blueprint $table) {
            //
        });
        Schema::table('usuario', function (Blueprint $table) {
            //
        });
    }
};
