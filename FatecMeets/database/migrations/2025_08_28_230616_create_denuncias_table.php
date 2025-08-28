        <?php

        use Illuminate\Database\Migrations\Migration;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Support\Facades\Schema;

        return new class extends Migration {
            public function up(): void {
                Schema::create('denuncias', function (Blueprint $table) {
    $table->bigIncrements('id');
    $table->unsignedBigInteger('usuario_id');
    $table->unsignedBigInteger('arquivo_morto_id');
    $table->unsignedBigInteger('administrador_id')->nullable();
    $table->string('tipo', 100);
    $table->text('descricao');
    $table->enum('status', ['aberta','em_analise','resolvida','arquivada'])->default('aberta');
    $table->timestamps();

    $table->foreign('usuario_id')->references('id')->on('usuarios')->onDelete('cascade');
    $table->foreign('administrador_id')->references('id')->on('administradores')->onDelete('set null');
    $table->foreign('arquivo_morto_id')->references('id')->on('arquivos_mortos')->onDelete('cascade');
});

            }

            public function down(): void {
                Schema::dropIfExists('denuncias');
            }
        };
