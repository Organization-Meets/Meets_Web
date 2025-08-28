        <?php

        use Illuminate\Database\Migrations\Migration;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Support\Facades\Schema;

        return new class extends Migration {
            public function up(): void {
                Schema::create('alunos', function (Blueprint $table) {
    $table->bigIncrements('id');
    $table->unsignedBigInteger('usuario_id');
    $table->string('nome');
    $table->string('ra', 20)->unique();
    $table->timestamps();

    $table->foreign('usuario_id')->references('id')->on('usuarios')->onDelete('cascade');
});

            }

            public function down(): void {
                Schema::dropIfExists('alunos');
            }
        };
