        <?php

        use Illuminate\Database\Migrations\Migration;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Support\Facades\Schema;

        return new class extends Migration {
            public function up(): void {
                Schema::create('atividades', function (Blueprint $table) {
    $table->bigIncrements('id');
    $table->integer('likes')->default(0);
    $table->enum('tipo', ['postagem','comentario','evento','participacao']);
    $table->timestamps();
});

            }

            public function down(): void {
                Schema::dropIfExists('atividades');
            }
        };
