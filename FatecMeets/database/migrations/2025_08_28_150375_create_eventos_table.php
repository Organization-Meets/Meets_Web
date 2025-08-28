        <?php

        use Illuminate\Database\Migrations\Migration;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Support\Facades\Schema;

        return new class extends Migration {
            public function up(): void {
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

            }

            public function down(): void {
                Schema::dropIfExists('eventos');
            }
        };
