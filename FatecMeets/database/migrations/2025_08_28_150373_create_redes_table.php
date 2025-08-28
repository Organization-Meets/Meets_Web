        <?php

        use Illuminate\Database\Migrations\Migration;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Support\Facades\Schema;

        return new class extends Migration {
            public function up(): void {
                Schema::create('redes', function (Blueprint $table) {
    $table->bigIncrements('id');
    $table->unsignedBigInteger('adicional_id');
    $table->enum('tipo', ['instagram','linkedin','github','twitter','facebook','outro']);
    $table->string('url', 500);
    $table->timestamps();

    $table->foreign('adicional_id')->references('id')->on('adicionais');
});

            }

            public function down(): void {
                Schema::dropIfExists('redes');
            }
        };
