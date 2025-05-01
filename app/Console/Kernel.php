<?php

namespace App\Console;

use App\Console\Commands\CheckLowStocks;
use App\Console\Commands\SendAppointmentReminders;
use App\Console\Commands\SendVaccinationReminders;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */

    protected $commands = [
        SendAppointmentReminders::class,
        SendVaccinationReminders::class,
        CheckLowStocks::class,
    ];
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('appointments:send-reminders')->dailyAt('06:00');
        $schedule->command('vaccination:send-reminders')->dailyAt('06:00');
        // $schedule->command('stocks:check-low')->dailyAt('06:00');
        $schedule->command('stocks:check-low')->everyMinute();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
