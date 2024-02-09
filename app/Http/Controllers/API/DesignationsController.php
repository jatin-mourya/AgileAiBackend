<?php

namespace App\Http\Controllers\API;
//use DB   
use Illuminate\Support\Facades\DB;;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Designations;

class DesignationsController extends Controller
{
    public function index()
    {
        $designations = DB::table('designations')
                            ->where('boolean_value', '1')
                            ->orderBy('updated_at', 'DESC')
                            ->get();
		return response()->json($designations);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $newDesignations = new Designations([
			
            'designation' => $request->get('designation')
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
            'designation' => 'required|unique:designations'
		]);

		$newDesignations = new Designations([
            'designation' => $request->get('designation')
		]);

		$newDesignations->save();

		return response()->json($newDesignations);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($designation_id)
    {
        $designations = Designations::findOrFail($designation_id);
		return response()->json($designations);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($designation_id)
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
    public function update(Request $request, $designation_id)
    {
		
		$designations = Designations::findOrFail($designation_id);
		
		$designations = Designations::find($designation_id);
        $designations->update($request->all());
        return $designations;
		
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($designation_id)
    {
        $designations = Designations::findOrFail($designation_id);

        $designations = Designations::find($designation_id);
        if ($designations) {
            $designations->boolean_value = 0;
            // $designations->save();
            $designations->save();
            return $designations;
        }

    }
}
