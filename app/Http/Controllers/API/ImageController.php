<?php

namespace App\Http\Controllers\API;
use App\Models\Image;
use App\Models\EmpStatus;

//use DB   
use Illuminate\Support\Facades\DB;;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ImageController extends Controller
{


    public function index()
    {
       $image = DB::table('emp_documents')
      ->where('boolean_value', '1')
      ->orderBy('updated_at', 'DESC')
      ->get();
       return response()->json($image);
    }

    public function create(Request $request){
        $newImage = new Image([
          'user_id' => $request->get('user_id'),
        'doc1' => $request->get('doc1'),
        'doc2' => $request->get('doc2'),
        'doc3' => $request->get('doc3'),
        'doc4' => $request->get('doc4'),
        'doc5' => $request->get('doc5')
    ]);
    }

    public function store(Request $request)
    {
      //dd($request->all());
      
      $request->file('doc1');
      $request->file('doc2');
      $request->file('doc3');
      $request->file('doc4');
      $request->file('doc5');


      $user_id = $request->get('user_id');

      $file = $request->file('doc1');
      $file2 = $request->file('doc2');
      $file3 = $request->file('doc3');
      $file4 = $request->file('doc4');
      $file5 = $request->file('doc5');
    //  $size = $request->file('doc1')->getSize();
      $name = $request->file('doc1')->getClientOriginalName();
      $name2 = $request->file('doc2')->getClientOriginalName();
      $name3 = $request->file('doc3')->getClientOriginalName();
      $name4 = $request->file('doc4')->getClientOriginalName();
      $name5 = $request->file('doc5')->getClientOriginalName();

      $picture   = date('His').'-'.$name;
      $picture2   = date('His').'-'.$name2;
      $picture3   = date('His').'-'.$name3;
      $picture4   = date('His').'-'.$name4;
      $picture5   = date('His').'-'.$name5;

      $FileDestinationPath = "public/img/".$name;
      $FileDestinationPath2 = "public/img/".$name2;
      $FileDestinationPath3 = "public/img/".$name3;
      $FileDestinationPath4 = "public/img/".$name4;
      $FileDestinationPath5 = "public/img/".$name5;
      //move image to public/img folder

      $file->move(public_path("img"), $name);
     // $path = '/img/' . $name;

      //$file->move(('../../Angular/src/assets/img'), $name);
      $file2->move(('../../Angular/src/assets/img'), $name2);
      $file3->move(('../../Angular/src/assets/img'), $name3);
      $file4->move(('../../Angular/src/assets/img'), $name4);
      $file5->move(('../../Angular/src/assets/img'), $name5);

      $empDocumnet = new Image();

      $empDocumnet->user_id = $user_id;
      $empDocumnet->doc1 = $name;
      $empDocumnet->doc2 = $name2;
      $empDocumnet->doc3 = $name3;
      $empDocumnet->doc4 = $name4;
      $empDocumnet->doc5 = $name5;

      $empDocumnet->save(); 
      return response()->json($empDocumnet);

    
    }


  //   public function show($emp_doc_id)
  // {
  //   $image = Image::findOrFail($emp_doc_id);
  //   return response()->json($image);
  

  /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
  public function update(Request $request, $doc_id)
  {
    $image = Image::findOrFail($doc_id);
    $image = Image::find($doc_id);
    $image->update($request->all());
    return $image;

    
  }
  public function show($doc_id)
  {
    $Image = DB::table('emp_documents') 
    ->where('user_id', $doc_id)
    ->get();
  return response()->json($Image);


  }

  /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
  public function destroy($emp_status_id)
  {
    $empstatus = Empstatus::findOrFail($emp_status_id);
    $empstatus->delete();

    return response()->json($empstatus::all());
  }
}
