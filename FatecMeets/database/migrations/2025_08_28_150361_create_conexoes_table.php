        <?php

        use Illuminate\Database\Migrations\Migration;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Support\Facades\Schema;

        return new class extends Migration {
            public function up(): void {
                Schema::create('conexoes', function (Blueprint $table) {
    $table->bigIncrements('id');
    $table->unsignedBigInteger('usuario_origem_id');
    $table->unsignedBigInteger('usuario_destino_id');
    $table->enum('status', ['pendente', 'aceito', 'recusado', 'bloqueado'])->default('pendente');
    $table->timestamps();

    $table->foreign('usuario_origem_id')->references('id')->on('usuarios')->onDelete('cascade');
    $table->foreign('usuario_destino_id')->references('id')->on('usuarios')->onDelete('cascade');
    $table->unique(['usuario_origem_id', 'usuario_destino_id']);
});

            }

            public function down(): void {
                Schema::dropIfExists('conexoes');
            }
        };
