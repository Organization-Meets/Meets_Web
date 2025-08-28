        <?php

        use Illuminate\Database\Migrations\Migration;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Support\Facades\Schema;

        return new class extends Migration {
            public function up(): void {
                Schema::create('participacoes', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('evento_id');
    $table->unsignedBigInteger('usuario_id');
    $table->unsignedBigInteger('atividade_id');
    $table->enum('status_intencao', ['salvo', 'confirmado', 'furou', 'cancelado', 'aberto'])->default('aberto');
    $table->timestamps();
    $table->unique(['usuario_id', 'evento_id']);

    $table->foreign('usuario_id')->references('id')->on('usuarios')->onDelete('cascade');
    $table->foreign('evento_id')->references('id')->on('eventos')->onDelete('cascade');
    $table->foreign('atividade_id')->references('id')->on('atividades')->onDelete('cascade');
});

            }

            public function down(): void {
                Schema::dropIfExists('participacoes');
            }
        };
