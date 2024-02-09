<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Month;

class MonthController extends Controller
{
    //
    public function index()
    {
        $month = Month::all();
      return response()->json($month);
    }

    public function show($id)
    {
        $month = Month::findOrFail($id);
		return response()->json($month);
    }
}
