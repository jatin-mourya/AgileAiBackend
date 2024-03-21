<?php

namespace App\Http\Controllers;

use App\Models\chartsModel;
use App\Models\Leadsource;
use Carbon\Carbon;
// import date package
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ChartsController extends Controller
{
    // ######################## charts API created by jatin (starts here) ######################## //
    // ######################## charts API created by jatin (starts here) ######################## //

    // get columns by module name
    public function getTableColumnsByModuleName($moduleName)
    {
        $tableName = '';
        $tablesToLoop = [];
        $salesRelatedTables = ['salesdetails', 'clientdetails', 'teams', 'users', 'debtor_company_det', 'channelpartner', 'projects', 'subprojects', 'payout_status', 'leadsource', 'inv_status'];
        $invoiceRelatedTables = ['invoice_multi', 'invoicedetids'];

        if ($moduleName == 'sales') {
            $tableName = 'salesdetails';
            $tablesToLoop = $salesRelatedTables;
        }
        if ($moduleName == 'invoice') {
            $tableName = 'invoice_multi';
            $tablesToLoop = $invoiceRelatedTables;
        }

        function loopthrough($modulesTable)
        {

            $allColsData = [];
            foreach ($modulesTable as $i => $table) {

                // Check if the table exists
                if (Schema::hasTable($table)) {
                    $columns = Schema::getColumnListing($table);

                    foreach ($columns as $i => $col) {
                        array_push($allColsData, ["id" => count($allColsData) + 1, "table" => $table, "col" => $col]);
                    }
                } else {
                    // Return error response if the table doesn't exist
                    return response()->json(['error' => "$table , Table not found "], 404);
                }
            }
            return $allColsData;
        }
        // Check if the table exists
        if (Schema::hasTable($tableName)) {
            // Get columns for the selected table
            $columns = loopthrough($tablesToLoop);
            return response()->json($columns);
        } else {
            // Return error response if the table doesn't exist
            return response()->json(['error' => "$tableName , Table not found "], 404);
        }
    }
    public function getRelatedTables($tableName)
    {
        // $foreignKeys = Schema::getConnection()->getDoctrineSchemaManager()->listTableForeignKeys($tableName);
        // $relatedTables = [];
        // foreach ($foreignKeys as $constraint) {
        //     // Extract the referenced table name
        //     $relatedTables[] = $constraint->getLocalColumns()[0];
        // }
        // return response()->json($relatedTables);

        // all tables
        $tables = Schema::getConnection()->getDoctrineSchemaManager()->listTableNames();

        // Check if the table exists
        if (Schema::hasTable($tableName)) {
            $allT = [];
            // foreach ($tables as $table) {
            // Get the foreign keys that reference the specified table
            // $foreignKeys = DB::select("SELECT TABLE_NAME
            //                             FROM information_schema.key_column_usage
            //                             WHERE referenced_table_name = $tableName
            //                             AND table_schema = DATABASE()");
            // // Extract the table names from the result
            // $relatedTables = array_map(function ($key) {
            //     return $key->TABLE_NAME;
            // }, $foreignKeys);
            // array_push($allT, $relatedTables);
            // }

            // Return the list of related tables as JSON response
            // return response()->json(['related_tables' => $relatedTables]);

        } else {
            // Return error response if the table doesn't exist
            return response()->json(['error' => 'Table not found'], 404);
        }
    }
    public function getChart2(Request $request)
    {
        $now = Carbon::now();

        $pageNum = $request->input('pageNum') ?? 1;
        $perPage = $request->input('perPage') ?? 10;
        $skip = 0;
        if ($pageNum > 1) {
            $skip = ($pageNum - 1) * $perPage;
        }

        $moduleName = $request->input('moduleName') ?? '';

        $xaxis = $request->input('xaxis') ?? '';
        $yaxis = $request->input('yaxis') ?? '';

        $table_name_x = explode('.', $xaxis)[0] ?? '';
        $table_name_y = explode('.', $yaxis)[0] ?? '';

        $from_date = $request->input('from_date') ?? '';
        $to_date = $request->input('to_date') ?? '';

        $groupByX = $request->input('groupByX') ?? '';
        $filterByXvalue = $request->input('filterByXvalue') ?? '';

        // for as col_name
        $xaxisAS = explode('.', $xaxis)[1];
        $yaxisAS = explode('.', $yaxis)[1];

        if ($moduleName == 'sales') {
            $mainTable = 'salesdetails';
            $chartData = DB::table($mainTable)
                ->join('clientdetails', 'clientdetails.client_id', 'salesdetails.client_id')
                ->join('debtor_company_det', 'debtor_company_det.debtor_company_det_id', 'salesdetails.debtor_company_det_id')
                ->join('teams', 'teams.team_id', 'salesdetails.team_id')
                ->join('users', 'users.user_id', 'salesdetails.sourcing_emp_id')
                ->join('users as u2', 'u2.user_id', 'salesdetails.closing_emp_id')
                ->join('projects', 'projects.project_id', 'salesdetails.project_id')
                ->join('subprojects', 'subprojects.subproject_id', 'salesdetails.subproject_id')
            // ->join('channelpartner', 'channelpartner.cp_id', 'salesdetails.cp_id')
                ->join('inv_status', 'inv_status.inv_status_id', 'salesdetails.inv_status')
                ->join('leadsource', 'leadsource.leadsource_id', 'salesdetails.leadsource_id')
                ->join('payout_status', 'payout_status.payout_status_id', 'salesdetails.payout_status_id');

        } else if ($moduleName == 'invoice') {
            $mainTable = 'invoice_multi';
            $chartData = DB::table($mainTable)
                ->join('invoicedetids', 'invoicedetids.invoice_multi_id', 'invoice_multi.invoice_multi_id');

        }

        // from_date
        if ($from_date) {
            $chartData = $chartData->where($mainTable . '.' . 'created_at', '>', $from_date);
        }
        // to_date
        if ($to_date) {
            $chartData = $chartData->where($mainTable . '.' . 'created_at', '<', $to_date);
        }

        // if filter by x axis value
        if ($filterByXvalue) {
            $chartData = $chartData
                ->where($xaxis, $filterByXvalue);
        }

        $chartData = $chartData
            ->select($xaxis, DB::raw("CAST(sum($yaxis)AS UNSIGNED) as $yaxisAS"))
            ->groupBy($xaxis);
        // if groupBy value passed
        // if ($groupByX) {
        //     $chartData = $chartData
        //         ->select($xaxis, DB::raw("CAST(sum($yaxis)AS UNSIGNED) as $yaxisAS"))
        //         ->groupBy($xaxis);
        // } else {
        //     $chartData = $chartData
        //         ->select($xaxis, DB::raw("CAST($yaxis AS UNSIGNED) as $yaxisAS"));
        // }

        // getting total pages available
        $totalPages = 1;
        if ($perPage > 0) {
            $totalPages = ceil($chartData->get()->count() / $perPage);
        }

        // getting total count of bars
        $totalBars = $chartData->get()->count();

        // SKIP
        if ($skip) {
            $chartData = $chartData
                ->skip($skip);
        }

        // ORDER BY
        $chartData = $chartData
            ->orderBy($xaxis);

        // LIMIT
        if ($perPage) {
            $chartData = $chartData
                ->limit($perPage);
        }

        //  return sql query
        $sqlQuery = $chartData->toSql();

        // return data if found
        $chartData = $chartData->get();

        $chartData2 = [];
        foreach ($chartData as $i => &$item) {
            $chartData2[] = [$xaxisAS => $item->$xaxisAS ?? 'undefined', $yaxisAS => $item->$yaxisAS ?? 0];
        }

        return response()->json([
            'totalPages' => $totalPages,
            'totalBars' => $totalBars,
            'data' => $chartData2,
            'z' => $sqlQuery]);

    }
    public function getChart(Request $request)
    {
        $now = Carbon::now();

        $table_name = $request->input('table_name');
        $xaxis = $request->input('xaxis');
        $yaxis = $request->input('yaxis');
        $perPage = $request->input('limit');
        $filterByXvalue = $request->input('filterByXvalue');

        $daterange = $request->input('daterange');
        $dateRangeArr = explode(',', $daterange);

        $from_date = $dateRangeArr[0];
        $to_date = $dateRangeArr[1];

        if (empty($from_date)) {
            $from_date = '1970-01-01';
        }
        if (empty($to_date)) {
            $to_date = $now->format('Y-m-d');
        }

        // dd($from_date, $to_date);

        $chartData = DB::table($table_name)
            ->select($xaxis, DB::raw("sum($yaxis) as $yaxis"))
            ->where('created_at', '>', $from_date)
            ->where('created_at', '<', $to_date)
        // ->where($xaxis, $filterByXvalue)
            ->groupBy($xaxis)
            ->limit($perPage)
            ->get();

        // dd($chartData);
        $sqlQuery = DB::table($table_name)
            ->select($xaxis, DB::raw("sum($yaxis) as $yaxis"))
            ->where('created_at', '>', $from_date)
            ->where('created_at', '<', $to_date)
        // ->where($xaxis, $filterByXvalue)
            ->groupBy($xaxis)
            ->limit($perPage)
            ->toSql();

        return response()->json(['data' => $chartData, 'sqlQuery' => $sqlQuery]);
    }
    // Get all table names from the database schema
    public function getTableList()
    {
        // working 1
        $tables = Schema::getConnection()->getDoctrineSchemaManager()->listTableNames();
        $allTables = [];
        foreach ($tables as $i => $t) {
            $allTables[] = ["id" => $i + 1, "table" => $t];
        }
        // working 2
        // $tables = DB::select('SHOW TABLES');
        // working 3
        // $tables = Schema::getAllTables();
        // Return the list of tables as JSON response
        return response()->json($allTables);
    }
    // Get all columns names from the table name
    public function getTableColumns($tableName)
    {
        // Check if the table exists
        if (Schema::hasTable($tableName)) {
            // Get columns for the selected table
            $columns = Schema::getColumnListing($tableName);
            $allCols = [];
            foreach ($columns as $i => $c) {
                $allCols[] = ["id" => $i + 1, "col" => $c];
            }
            // Return the columns as JSON response
            return response()->json($allCols);
        } else {
            // Return error response if the table doesn't exist
            return response()->json(['error' => 'Table not found'], 404);
        }
    }
    // ######################## charts API created by jatin (ends here) ######################## //
    // ######################## charts API created by jatin (ends here) ######################## //

    public function index()
    {
        $charts = DB::table('charts')
            ->get();
        return response()->json($charts);
    }

    public function create(Request $request)
    {
        $createChart = new chartsModel([
            'json_obj' => $request->get('json_obj'),
        ]);
        return response()->json($createChart);
    }

    public function store(Request $request)
    {
        $obj = $request->input('json_obj');
        $stringg = json_encode($obj);
        $createChart = new chartsModel([
            'json_obj' => $stringg,
        ]);

        $createChart->save();

        return response()->json($createChart);
    }
    // ########################  Function by jatin (starts here)  ######################## //
    // ########################  Function by jatin (starts here)  ######################## //
    public function getDashboardChart(Request $request)
    {
        $from_date = $request->input('from_date') ?? '';
        $to_date = $request->input('to_date') ?? '';

        $leadsource = Leadsource::all();
        $leadsource = DB::table('leadsource')
            ->pluck('leadsource')
            ->toArray();
        // return response()->json($leadsource);
        foreach ($leadsource as $i => $item) {

            $salesdetail = DB::table('salesdetails')
                ->leftJoin('leadsource', 'leadsource.leadsource_id', 'salesdetails.leadsource_id')
                ->select('leadsource.leadsource', DB::raw('count(leadsource.leadsource) as count'))
                ->where('leadsource', $item)
                ->groupBy('leadsource.leadsource');

            if ($from_date) {
                $salesdetail = $salesdetail->where('salesdetails.booking_date', '>', $from_date);
            }
            if ($to_date) {
                $salesdetail = $salesdetail->where('salesdetails.booking_date', '<', $to_date);
            }

            $salesdetail = $salesdetail->first();

            if ($salesdetail) {
                $salesdetails[] = $salesdetail;
            } else {
                $salesdetails[] = [
                    'leadsource' => $item,
                    'count' => 0,
                ];
            }
        }
        return response()->json($salesdetails);
    }
    // ########################  Function by jatin (ends here)  ######################## //
    // ########################  Function by jatin (ends here)  ######################## //
}
