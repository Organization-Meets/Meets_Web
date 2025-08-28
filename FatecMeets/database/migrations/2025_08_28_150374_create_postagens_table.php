        <?php

        use Illuminate\Database\Migrations\Migration;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Support\Facades\Schema;

        return new class extends Migration {
            public function up(): void {
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

            }

            public function down(): void {
                Schema::dropIfExists('postagens');
            }
        };
