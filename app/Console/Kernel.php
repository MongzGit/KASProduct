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
        \App\Console\Commands\IncrementUpdatesCounter::class,
        \APP\Console\Commands\updatePostGenInforB::class,
        \APP\Console\Commands\updatePostGenInforC::class,
        \APP\Console\Commands\updatePostGenInforD::class,
        \APP\Console\Commands\updatePostGenInforE::class,
        \APP\Console\Commands\updatePostGenInforF::class,
        \APP\Console\Commands\updatePostGenInforG::class,
        \App\Console\Commands\updateTeamStats::class,

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
            ->everyTwoHours()
            ->when(function () {
                return PostBI::where('post_general_infor1', 'a')->exists();
            });

        // Schedule for posts with posty_type 'b'
            $schedule->command('command:updatePostGenInforB')
            ->everyFourHours()
            ->when(function () {
                return PostBI::where('post_general_infor1', 'b')->exists();
            });

        // Schedule for posts with posty_type 'b'
            $schedule->command('command:updatePostGenInforC')
            ->everySixHours()
            ->when(function () {
                return PostBI::where('post_general_infor1', 'c')->exists();
            });

            $schedule->command('command:updatePostGenInforD')
            ->cron('0 */10 * * *')
            ->when(function () {
                return PostBI::where('post_general_infor1', 'd')->exists();
            });

            $schedule->command('command:updatePostGenInforE')
            ->cron('0 */14 * * *')
            ->when(function () {
                return PostBI::where('post_general_infor1', 'e')->exists();
            });
            $schedule->command('command:updatePostGenInforF')
            ->cron('0 */18 * * *')
            ->when(function () {
                return PostBI::where('post_general_infor1', 'f')->exists();
            });
            $schedule->command('command:updatePostGenInforG')
            ->cron('0 */22 * * *')
            ->when(function () {
                return PostBI::where('post_general_infor1', 'g')->exists();
            });

            $schedule->command('games:update-team-stats')->hourly(); // or daily()

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
