<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Retorna uma nova classe anônima que estende Migration
return new class extends Migration
{
    /**
     * Executa as migrações.
     *
     * @return void
     */
    public function up()
    {
        // Cria a tabela 'failed_jobs' no banco de dados
        Schema::create('failed_jobs', function (Blueprint $table) {
            // Adiciona uma coluna 'id' auto-incrementável como chave primária
            $table->id();
            // Adiciona uma coluna 'uuid' única para identificar o job
            $table->string('uuid')->unique();
            // Adiciona uma coluna 'connection' para armazenar o nome da conexão
            $table->text('connection');
            // Adiciona uma coluna 'queue' para armazenar o nome da fila
            $table->text('queue');
            // Adiciona uma coluna 'payload' para armazenar os dados do job
            $table->longText('payload');
            // Adiciona uma coluna 'exception' para armazenar detalhes da exceção
            $table->longText('exception');
            // Adiciona uma coluna 'failed_at' para registrar quando o job falhou, usando o horário atual por padrão
            $table->timestamp('failed_at')->useCurrent();
        });
    }

    /**
     * Reverte as migrações.
     *
     * @return void
     */
    public function down()
    {
        // Remove a tabela 'failed_jobs' do banco de dados
        Schema::dropIfExists('failed_jobs');
    }
};
