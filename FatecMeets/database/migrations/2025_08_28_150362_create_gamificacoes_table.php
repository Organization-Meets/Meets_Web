        <?php

        use Illuminate\Database\Migrations\Migration;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Support\Facades\Schema;

        return new class extends Migration {
            public function up(): void {
                Schema::create('gamificacoes', function (Blueprint $table) {
    $table->bigIncrements('id');
    $table->integer('score_total')->default(0);
    $table->string('nickname', 100)->unique()->nullable();
    $table->unsignedBigInteger('usuario_id');
    $table->timestamps();

    $table->foreign('usuario_id')->references('id')->on('usuarios');
});

            }

            public function down(): void {
                Schema::dropIfExists('gamificacoes');
            }
        };
