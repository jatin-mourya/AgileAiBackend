<?php

namespace App\Http\Controllers\API;
use App\Models\EmpComments;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use DB  
use Illuminate\Support\Facades\DB;;

class EmpCommentsController extends Controller
{
    public function index()
  {
    $empcomments = Empcomments::all();
    $empcomments = DB::table('emp_comments')
    ->join('users', 'users.user_id', '=', 'emp_comments.user_id')
    ->select('emp_comments.*','users.user_id')
    ->orderBy('emp_comments.updated_at','DESC')
    ->get();
    return response()->json($empcomments);
  }
  public function create(Request $request)
  {
      //$newusersData = $newusers->getNewusers($request->email);

 


    $newEmpcomments = new Empcomments([
    'user_id' => $request->get('user_id'),
    'comment' => $request->get('comment')
     
      
      ]);
  }
  /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
  public function store(Request $request)
  {
    $request->validate([
      'user_id' => 'required|max:255',
      'comment' => 'required'
   
    ]);

    $newEmpcomments = new Empcomments([
      'user_id' => $request->get('user_id'),
      'comment' => $request->get('comment')
     
    ]);

    $newEmpcomments->save();

    return response()->json($newEmpcomments);
  }

  /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
  public function show($comment_id)
  {
    
    $empcomments = Empcomments::findOrFail($comment_id);
    $empcomments = DB::table('emp_comments')
    ->join('users', 'users.user_id', '=', 'emp_comments.user_id')
    ->select('emp_comments.*','users.user_id')
    ->where('emp_comments.user_id',$comment_id)
    ->get();
    
    return response()->json($empcomments);
  }

  /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
  public function update(Request $request, $comment_id)
  {
    $empcomments = Empcomments::findOrFail($comment_id);
    $empcomments = Empcomments::find($comment_id);
    $empcomments->update($request->all());
    return $empcomments;

    
  }

  /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
  public function destroy($comment_id)
  {
    $empcomments = Empcomments::findOrFail($comment_id);
    $empcomments->delete();

    return response()->json($empcomments::all());
  }
}
