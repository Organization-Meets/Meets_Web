        <?php

        use Illuminate\Database\Migrations\Migration;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Support\Facades\Schema;

        return new class extends Migration {
            public function up(): void {
                Schema::create('instituicoes', function (Blueprint $table) {
    $table->bigIncrements('id');
    $table->unsignedBigInteger('administrador_id');
    $table->string('nome');
    $table->string('codigo', 50)->unique()->nullable();
    $table->unsignedBigInteger('telefone_id');
    $table->unsignedBigInteger('endereco_id');
    $table->timestamps();

    $table->foreign('administrador_id')->references('id')->on('administradores')->onDelete('cascade');
    $table->foreign('endereco_id')->references('id')->on('enderecos')->onDelete('cascade');
    $table->foreign('telefone_id')->references('id')->on('telefones')->onDelete('cascade');
});

            }

            public function down(): void {
                Schema::dropIfExists('instituicoes');
            }
        };
