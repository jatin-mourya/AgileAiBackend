<?php
   
namespace App\Console\Commands;
   
use Illuminate\Console\Command;
use App\Library\Services\DemoFour;
use App\Models\monthbasislead;
use Illuminate\Http\Request;
use App\Providers\monthLeadServiceProvider;
use DB;
   
class monthleadCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'monthlead:cron';
    
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
       $customServiceInstance3 = new DemoFour;
       \Log::info($customServiceInstance3->doSomethingUseful3());
        // \Log::info($customServiceInstance,"Cron is working fine!");
     
        /*
           Write your database logic we bellow:
           Item::create(['name'=>'hello new']);
        */
    }
}