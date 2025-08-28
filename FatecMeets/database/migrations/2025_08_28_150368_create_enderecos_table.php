        <?php

        use Illuminate\Database\Migrations\Migration;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Support\Facades\Schema;

        return new class extends Migration {
            public function up(): void {
                Schema::create('enderecos', function (Blueprint $table) {
    $table->bigIncrements('id');
    $table->string('numero', 10)->nullable();
    $table->string('cep', 10);
    $table->timestamps();
});

            }

            public function down(): void {
                Schema::dropIfExists('enderecos');
            }
        };
