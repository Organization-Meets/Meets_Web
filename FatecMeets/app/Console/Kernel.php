<?php

namespace App\Console;

// Importa a classe Schedule para agendamento de comandos
use Illuminate\Console\Scheduling\Schedule;
// Importa a classe base do Kernel do Console do Laravel
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

// Classe Kernel responsável por gerenciar comandos e agendamentos do console
class Kernel extends ConsoleKernel
{
    /**
     * Define o agendamento de comandos da aplicação.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule  Instância do agendador de comandos
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Exemplo de agendamento de comando: executa o comando 'inspire' a cada hora
        // $schedule->command('inspire')->hourly();
    }

    /**
     * Registra os comandos disponíveis na aplicação.
     *
     * @return void
     */
    protected function commands()
    {
        // Carrega todos os comandos personalizados do diretório Commands
        $this->load(__DIR__.'/Commands');

        // Inclui o arquivo de rotas de comandos do console
        require base_path('routes/console.php');
    }
}

