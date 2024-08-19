<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\PostBI;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Schedule for posts with posty_type 'a'
        $schedule->command('command:incrementCounter')
            ->everyTenMinutes()
            ->when(function () {
                return PostBI::where('post_type', 'b')->exists();
            });

        // Schedule for posts with posty_type 'b'
        $schedule->command('command:incrementCounter')
            ->everyFifteenMinutes()
            ->when(function () {
                return PostBI::where('post_type', 'c')->exists();
            });
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
