        <?php

        use Illuminate\Database\Migrations\Migration;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Support\Facades\Schema;

        return new class extends Migration {
            public function up(): void {
                Schema::create('arquivos_mortos', function (Blueprint $table) {
    $table->bigIncrements('id');
    $table->unsignedBigInteger('usuario_id');
    $table->string('tabela_origem', 100);
    $table->bigInteger('registro_origem_id');
    $table->text('motivo_exclusao')->nullable();
    $table->json('dados')->nullable();
    $table->timestamps();

    $table->foreign('usuario_id')->references('id')->on('usuarios')->onDelete('cascade');
});

            }

            public function down(): void {
                Schema::dropIfExists('arquivos_mortos');
            }
        };
