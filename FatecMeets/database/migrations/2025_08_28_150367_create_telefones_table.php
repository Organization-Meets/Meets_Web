        <?php

        use Illuminate\Database\Migrations\Migration;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Support\Facades\Schema;

        return new class extends Migration {
            public function up(): void {
                Schema::create('telefones', function (Blueprint $table) {
    $table->bigIncrements('id');
    $table->string('numero', 15);
    $table->string('ddd', 3);
    $table->enum('tipo', ['celular','residencial','comercial'])->default('celular');
    $table->timestamps();
});

            }

            public function down(): void {
                Schema::dropIfExists('telefones');
            }
        };
