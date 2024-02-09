<?php

namespace App\Http\Controllers\API;
use Illuminate\Support\Facades\DB;

use App\Models\Tickets;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TicketsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $tickets = Tickets::all();
             $tickets=DB::table('tickets')
                   
                    ->select('ticket_id','teams.teamname', 'users.firstname', 'users.lastname','clientdetails.name','task_name', 'task_description', 'task_due','ticket_priority', 'ticket_status', 'ticket_category', 'ticket_severity')
                    ->join('teams','teams.team_id','=','tickets.team_id')
                    ->join('users', 'users.user_id', '=', 'tickets.user_id')
                    ->leftjoin('clientdetails', 'clientdetails.client_id', '=', 'tickets.client_id')
                    ->orderBy('tickets.updated_at', 'desc')
                    ->get();
                    
        return response()->json($tickets);
         

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    // post 
    public function create(Request $request)
    {
        $newTickets =new Tickets([
            'team_id'=>$request->get('team_id'),
            'user_id'=>$request->get('user_id'),
            'task_name'=>$request->get('task_name'),
            'task_description'=>$request->get('task_description'),
            'task_due'=>$request->get('task_due'),
            'client_id'=>$request->get('client_id'),

            'ticket_priority'=>$request->get('ticket_priority'),
            'ticket_status'=>$request->get('ticket_status'),
            'ticket_category'=>$request->get('ticket_category'),
            'ticket_severity'=>$request->get('ticket_severity'),
            // dd($request->get('team_id'))
        ]);
       
        $newTickets->save();
         return response()->json($newTickets);
    }
     


        
        
        
    
    //store
    public function store(Request $request)
    {
        $request->validate([
            'team_id'=>'required',
            'user_id' => 'required',
            'task_name' => '',
            'task_description' => '',
            'task_due' => '',
            'client_id' => '',

            'ticket_priority'=>'required',
            'ticket_status'=>'required',
            'ticket_category'=>'required',
            'ticket_severity'=>'required',
        ]);


        $newTickets =new Tickets([
            'team_id'=>$request->get('team_id'),
            'user_id'=>$request->get('user_id'),
            'task_name'=>$request->get('task_name'),
            'task_description'=>$request->get('task_description'),
            'task_due'=>$request->get('task_due'),
            'client_id'=>$request->get('client_id'),
            'ticket_priority'=>$request->get('ticket_priority'),
            'ticket_status'=>$request->get('ticket_status'),
            'ticket_category'=>$request->get('ticket_category'),
            'ticket_severity'=>$request->get('ticket_severity'),
            dd($request->get('team_id'))
        ]);
        $newTickets->save();
        return response()->json($newTickets);


    }

   //Get by id
    public function getbyid($ticket_id){
    
        $tickets = DB::table('tickets')
         ->select('tickets.*')
         ->where('tickets.ticket_id',$ticket_id)
         ->orderBy('tickets.updated_at', 'desc')
         ->get();
        return response()->json( $tickets);
        // dd($tickets)
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tickets  $tickets
     * @return \Illuminate\Http\Response
     */
    public function show(Tickets $tickets)
    {
         $tickets = Tickets::findOrFail($ticket_id) ;
	     return response()->json($tickets);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tickets  $tickets
     * @return \Illuminate\Http\Response
     */
    public function update($tickets_id, Request $request,)
    {
         $tickets = Tickets::findOrFail($tickets_id);
		 $tickets = Tickets::find($tickets_id);
         $tickets->update($request->all());
         return $tickets;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tickets  $tickets
     * @return \Illuminate\Http\Response
     */

    public function destroy($tickets_id)
    {
        $tickets = Tickets::findOrFail($tickets_id);

    //    dd($tickets);
        if ($tickets) {


            $tickets = Tickets::find($tickets_id);
            if ($tickets) {
                //$tickets->boolean_value = 0;
                $tickets->save();
                $tickets->delete();
                //return response()->json(['message' => 'Data deleted successfully'], 200);
                return $tickets;
            }
           

        } 
        
    }
       
    // public function destroy($tickets_id)
    // {
    //     $tickets = Tickets::findOrFail($tickets_id);
	// 	$tickets->delete();

	// 	return response()->json($tickets::all());
    // }

    // public function deleteData($tickets_id)
    //     {
    //         $tickets = Tickets::findOrFail($tickets_id);
    
            
    //         if ($tickets) {
                
    //             $tickets->delete();
    //             return response()->json(['message' => 'Data deleted successfully'], 200);
    //         }
    
    //     }
    

    public function allteamdata($team_id){

        $tickets =  DB::table('users')
         ->select('users.firstname', 'users.lastname','users.*')
         ->join('teamdetails', 'teamdetails.user_id', '=', 'users.user_id')
         ->join('teams', 'teams.team_id', '=', 'teamdetails.team_id')
         ->where('teams.team_id', '=', $team_id )
        //  ->where('users.user_id')
         ->get();
           //  tosql();
        //   dd($team_id);
        return response()->json($tickets);
    }



      
}
