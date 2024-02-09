<?php

namespace App\Http\Controllers\API;
//use DB   
use Illuminate\Support\Facades\DB;;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Salesdocuments;

class SalesdocumentsController extends Controller
{

    public function index()
    {
        $salesdocuments = Salesdocuments::all();
        $salesdocuments = DB::table('sales_documents')
                        ->join('salesdetails', 'salesdetails.sales_id', '=', 'sales_documents.sales_id')
                        ->join('clientdetails', 'clientdetails.client_id', '=', 'salesdetails.client_id')
                        ->select('clientdetails.name', 'sales_documents.*')
                        ->orderBy('sales_documents.updated_at', 'DESC')
                        ->get();
		return response()->json($salesdocuments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // $files = $request->file('files');
        // $uploadPath = "public/image";
        // $originalImage = $files->getClientOriginalName();
        // $files->move($uploadPath,$originalImage);

        
        $newSalesdocuments = new Salesdocuments([
			
			'sales_id' => $request->get('sales_id'),
            'doc1' => $request->get('doc1'),
            'doc2' => $request->get('doc2'),
            'doc3' => $request->get('doc3'),
            'doc4' => $request->get('doc4'),
            'doc5' => $request->get('doc5')
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
       
        $request->file('doc1');
        $request->file('doc2');
        $request->file('doc3');
        $request->file('doc4');
        $request->file('doc5');
  
  
        $sales_id = $request->get('sales_id');
  
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
        $file2->move(public_path("img"), $name2);
        $file3->move(public_path("img"), $name3);
        $file4->move(public_path("img"), $name4);
        $file5->move(public_path("img"), $name5);
        // $file2->move(('../../Angular/src/assets/img'), $name2);
        // $file3->move(('../../Angular/src/assets/img'), $name3);
        // $file4->move(('../../Angular/src/assets/img'), $name4);
        // $file5->move(('../../Angular/src/assets/img'), $name5);
  
        $newSalesdocuments = new Salesdocuments();

        $newSalesdocuments->sales_id = $sales_id;
        $newSalesdocuments->doc1 = $name;
        $newSalesdocuments->doc2 = $name2;
        $newSalesdocuments->doc3 = $name3;
        $newSalesdocuments->doc4 = $name4;
        $newSalesdocuments->doc5 = $name5;
        $newSalesdocuments->save(); 
        return response()->json($newSalesdocuments);

        // $request->validate([
		
		// 	'sales_id' => 'required',
        //     'doc1' => 'required',
        //     'doc2' => 'required',
        //     'doc3' => 'required',
        //     'doc4' => 'required',
        //     'doc5' => 'required'
		// ]);

		// $newSalesdocuments = new Salesdocuments([
		
		// 	'sales_id' => $request->get('sales_id'),
        //     'doc1' => $request->get('doc1'),
        //     'doc2' => $request->get('doc2'),
        //     'doc3' => $request->get('doc3'),
        //     'doc4' => $request->get('doc4'),
        //     'doc5' => $request->get('doc5')
		// ]);

		// $newSalesdocuments->save();

		// return response()->json($newSalesdocuments);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function show($sales_doc_id)
    {
        $salesdocuments = Salesdocuments::findOrFail($sales_doc_id);
		return response()->json($salesdocuments);


    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($sales_doc_id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $sales_doc_id)
    {

        $salesdocuments = Salesdocuments::findOrFail($sales_doc_id);
		
		$salesdocuments = Salesdocuments::find($sales_doc_id);
        $salesdocuments->update($request->all());
        return $salesdocuments;

        // $teamleaders = Teamleaders::findOrFail($team_leader_id);

        // $teamleaders = Teamleaders::find($team_leader_id);
        // $teamleaders->status = $request->input('status');
        // $teamleaders->update();
        
        // return response()->json($teamleaders);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($sales_doc_id)
    {
        $salesdocuments = Salesdocuments::findOrFail($sales_doc_id);
		$salesdocuments->delete();

		return response()->json($salesdocuments::all());
    }
}
