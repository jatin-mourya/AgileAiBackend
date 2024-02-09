<?php
   
namespace App\Console\Commands;
   
use Illuminate\Console\Command;
use App\Library\Services\DemoThree;
use App\Models\Datebasislead;
use Illuminate\Http\Request;
use App\Providers\DateLeadServiceProvider;
use DB;
   
class DateleadCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Datelead:cron';
    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Execute the console command.
     *
     * @return mixed
     */
     
     
    public function handle()
    {
       $customServiceInstance2 = new DemoThree;
       \Log::info($customServiceInstance2->doSomethingUseful2());
        // \Log::info($customServiceInstance2,"Cron is working fine!");
     
        /*
           Write your database logic we bellow:
           Item::create(['name'=>'hello new']);
        */
    }
}