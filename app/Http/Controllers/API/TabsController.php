<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\tabs;

class TabsController extends Controller
{
    public function index()
    {
        $tabs = tabs::all();
		return response()->json($tabs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $tabs = new tabs([
            
                'tab_name' => $request->get('tab_name'),
                'status' => $request->get('status')
        

        ]);

    }

}
