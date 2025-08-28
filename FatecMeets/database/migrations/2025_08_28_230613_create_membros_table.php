        <?php

        use Illuminate\Database\Migrations\Migration;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Support\Facades\Schema;

        return new class extends Migration {
            public function up(): void {
                Schema::create('membros', function (Blueprint $table) {
    $table->bigIncrements('id');
    $table->unsignedBigInteger('chat_id');
    $table->unsignedBigInteger('usuario_id');
    $table->enum('role', ['membro','admin'])->default('membro');
    $table->timestamps();

    $table->foreign('chat_id')->references('id')->on('chats');
    $table->foreign('usuario_id')->references('id')->on('usuarios');
});

            }

            public function down(): void {
                Schema::dropIfExists('membros');
            }
        };
