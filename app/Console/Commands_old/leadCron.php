<?php
   
namespace App\Console\Commands;
   
use Illuminate\Console\Command;
use App\Library\Services\DemoTwo;
use App\Models\Leadsgiven;
use Illuminate\Http\Request;
use App\Providers\LeadServiceProvider;
use DB;
   
class LeadCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lead:cron';
    
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
        // DemoTwo $customServiceInstance1
       $customServiceInstance1 = new DemoTwo;
       \Log::info($customServiceInstance1->doSomethingUseful1());
        // \Log::info($customServiceInstance,"Cron is working fine!");
     
        /*
           Write your database logic we bellow:
           Item::create(['name'=>'hello new']);
        */
    }
}