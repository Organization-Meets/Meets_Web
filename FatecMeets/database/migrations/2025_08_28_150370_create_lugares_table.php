        <?php

        use Illuminate\Database\Migrations\Migration;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Support\Facades\Schema;

        return new class extends Migration {
            public function up(): void {
                Schema::create('lugares', function (Blueprint $table) {
    $table->bigIncrements('id');
    $table->unsignedBigInteger('endereco_id');
    $table->string('nome');
    $table->unsignedBigInteger('administrador_id')->nullable();
    $table->timestamps();

    $table->foreign('endereco_id')->references('id')->on('enderecos')->onDelete('cascade');
    $table->foreign('administrador_id')->references('id')->on('administradores')->onDelete('cascade');
});

            }

            public function down(): void {
                Schema::dropIfExists('lugares');
            }
        };
