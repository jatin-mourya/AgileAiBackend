<?php
   
namespace App\Console\Commands;
   
use Illuminate\Console\Command;
use App\Library\Services\DemoOne;
use App\Models\service;
use Illuminate\Http\Request;
use App\Providers\ProjectServiceProvider;
use DB;
   
class DemoCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demo:cron';
    
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
       $customServiceInstance = new DemoOne;
       \Log::info($customServiceInstance->doSomethingUseful());
        // \Log::info($customServiceInstance,"Cron is working fine!");
     
        /*
           Write your database logic we bellow:
           Item::create(['name'=>'hello new']);
        */
    }
}