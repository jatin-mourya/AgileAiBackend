<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\invoice_types;
use Illuminate\Http\Request;

class invoiceTypesController extends Controller
{
    public function index()
    {
        $invoiceTypes = invoice_types::all();
        $invoiceTypes = DB::table('invoice_types')
            ->select('*')
            ->get();
        return response()->json($invoiceTypes);
    }
}
