        <?php

        use Illuminate\Database\Migrations\Migration;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Support\Facades\Schema;

        return new class extends Migration {
            public function up(): void {
                Schema::create('adicionais', function (Blueprint $table) {
    $table->bigIncrements('id');
    $table->unsignedBigInteger('usuario_id');
    $table->unsignedBigInteger('telefone_id')->nullable();
    $table->unsignedBigInteger('endereco_id')->nullable();
    $table->unsignedBigInteger('instituicao_id')->nullable();
    $table->timestamps();

    $table->foreign('usuario_id')->references('id')->on('usuarios');
    $table->foreign('telefone_id')->references('id')->on('telefones');
    $table->foreign('endereco_id')->references('id')->on('enderecos');
    $table->foreign('instituicao_id')->references('id')->on('instituicoes');
});

            }

            public function down(): void {
                Schema::dropIfExists('adicionais');
            }
        };
