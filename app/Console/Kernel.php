<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Defina sua tarefa agendada aqui, por exemplo:
        $schedule->call(function () {
            // Chame o método de verificação de sinais de compra/venda
            app(\App\Http\Controllers\BitcoinController::class)->index();
        })->everyMinute(); // Execute a cada minuto, por exemplo
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');
    }
}
