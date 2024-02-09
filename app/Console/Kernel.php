<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
         Commands\DateleadCron::class,
        Commands\DemoCron::class,
         Commands\monthleadCron::class,
         Commands\yearleadCron::class,
         Commands\LeadCron::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
         $schedule->command('demo:cron')
                //  ->everyMinute();
                 ->dailyAt('00:30');
                 
        $schedule->command('lead:cron')
                //  ->everyMinute();
                 ->dailyAt('00:30');  
        $schedule->command('Datelead:cron')
                //  ->everyMinute();
                ->dailyAt('11:30');
        $schedule->command('monthlead:cron')
                //  ->everyMinute();
                ->monthly();      
                
                
    $schedule->command('cache:clear')->hourly();
    $schedule->command('config:clear')->hourly();
    $schedule->command('view:clear')->hourly();
    $schedule->command('route:clear')->hourly();
    $schedule->command('optimize:clear')->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
