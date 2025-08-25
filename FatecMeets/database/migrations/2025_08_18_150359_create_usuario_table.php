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
            $table->string('password', 255);
            $table->string('email_verification_token', 10)->nullable();
            $table->json('imagem_usuario')->nullable(); // <-- aqui virou JSON
            $table->enum('status_conta', ['ativo', 'inativo', 'suspenso'])->default('ativo');
            $table->timestamp('email_verified_at')->nullable(); // verificação de email
            $table->rememberToken() -> nullable(); // token "lembrar login"
            $table->timestamps(); // created_at e updated_at
        });

        Schema::create('gameficacao', function (Blueprint $table) {
            $table->bigIncrements('id_gameficacao');
            $table->integer('score_total')->default(0);
            $table->string('nickname', 100)->unique()->nullable();
            $table->unsignedBigInteger('id_usuario');
            $table->foreign('id_usuario')->references('id_usuario')->on('usuario');
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
        Schema::dropIfExists('usuario');
        Schema::dropIfExists('gameficacao');
    }
};
