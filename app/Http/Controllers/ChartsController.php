<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
// import date package
use Carbon\Carbon;

use function PHPUnit\Framework\isNan;
use function PHPUnit\Framework\isNull;

class ChartsController extends Controller
{
    // ######################## charts API created by jatin (starts here) ######################## //
    // ######################## charts API created by jatin (starts here) ######################## //

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
            $allCols = [];
            $allColsData = [];
            foreach ($modulesTable as $i => $table) {

                // Check if the table exists
                if (Schema::hasTable($table)) {
                    $columns = Schema::getColumnListing($table);

                    foreach ($columns as $i => $col) {
                        // $col = $table . '.' . $col;
                        array_push($allColsData, ['id' => count($allColsData) + 1, 'table' => $table, 'col' => $col]);

                        // $allColsData[$table][$i] = $col;
                    }
                    // array_push($allCols, $columns2);
                } else {
                    // Return error response if the table doesn't exist
                    return response()->json(['error' => "$table , Table not found "], 404);
                }
            }
            // return response()->json(['columns' => $allCols]);
            return $allColsData;
        }
        // Check if the table exists
        if (Schema::hasTable($tableName)) {
            // Get columns for the selected table

            $columns = loopthrough($tablesToLoop);
            // $columns = Schema::getColumnListing($tableName);
            // $columns2 = [];
            // foreach ($columns as $i => $item) {
            //     $item = $tableName . '.' . $item;
            //     // array_push($columns2, [$i + 1 => $item]);
            //     array_push($columns2, $item);
            // }
            // Return the columns as JSON response
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

        $salesRelatedTables = ['salesdetails', 'clientdetails', 'teams', 'users', 'debtor_company_det', 'channelpartner', 'projects', 'subprojects', 'payout_status', 'leadsource', 'inv_status'];
        $invoiceRelatedTables = ['invoice_multi', 'invoicedetids'];

        $moduleName = $request->input('moduleName');
        $table_name_x = $request->input('table_name_x');
        $table_name_y = $request->input('table_name_y');
        $xaxis = $request->input('xaxis');
        $yaxis = $request->input('yaxis');
        $limit = $request->input('limit');
        $filterByXvalue = $request->input('filterByXvalue');
        $groupByX = $request->input('groupByX');

        $daterange = $request->input('daterange');
        $dateRangeArr = explode(',', $daterange);

        $from_date = $dateRangeArr[0];
        $to_date = $dateRangeArr[1];

        if (empty($from_date) || isNull($from_date)) {
            $from_date = '1970-01-01';
        }
        if (empty($to_date) || isNull($to_date)) {
            $to_date = $now->format('Y-m-d');
        }
        // return response()->json($request);


        if ($moduleName == 'sales') {
            $mainTable = 'salesdetails';
        } else if ($moduleName == 'invoice') {
            $mainTable = 'invoice_multi';
        }
        // for as col_name
        $yaxisAS = explode('.', $yaxis)[1];

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
            ->join('payout_status', 'payout_status.payout_status_id', 'salesdetails.payout_status_id')
            // ->select($xaxis, DB::raw("sum($yaxis) as $yaxisAS"))
            ->where('salesdetails.created_at', '>', $from_date)
            ->where('salesdetails.created_at', '<', $to_date);
        //     // ->where($xaxis, $filterByXvalue)
        // ->groupBy($xaxis)
        // ->limit($limit)
        // ->get();
        // DB::raw("CAST(SUM($yaxis) AS UNSIGNED) AS $yaxisAS")
        if ($groupByX) {
            $chartData = $chartData
                ->select($xaxis, DB::raw("CAST(sum($yaxis)AS UNSIGNED) as $yaxisAS"))
                ->groupBy($xaxis);
        } else {
            $chartData = $chartData
                ->select($xaxis, $yaxis);
        }
        // if filter by x axis
        if ($filterByXvalue) {
            $chartData = $chartData
                ->where($xaxis, $filterByXvalue);
        }
        $chartData = $chartData
            ->orderBy($xaxis)
            ->limit($limit)->get();
        // dd($chartData);
        return response()->json(['data' => $chartData]);
        // $sqlQuery = DB::table($mainTable)
        //     ->join('clientdetails', 'clientdetails.client_id', 'salesdetails.client_id')
        //     ->join('debtor_company_det', 'debtor_company_det.debtor_company_det_id', 'salesdetails.debtor_company_det_id')
        //     ->join('teams', 'teams.team_id', 'salesdetails.team_id')
        //     ->join('users as u1', 'u1.user_id', 'salesdetails.sourcing_emp_id')
        //     ->join('users as u2', 'u2.user_id', 'salesdetails.closing_emp_id')
        //     ->join('projects', 'projects.project_id', 'salesdetails.project_id')
        //     ->join('subprojects', 'subprojects.subproject_id', 'salesdetails.subproject_id')
        //     // ->join('channelpartner', 'channelpartner.cp_id', 'salesdetails.cp_id')
        //     ->join('inv_status', 'inv_status.inv_status_id', 'salesdetails.inv_status')
        //     ->join('leadsource', 'leadsource.leadsource_id', 'salesdetails.leadsource_id')
        //     ->select($xaxis, DB::raw("sum($yaxis) as $yaxisAS"))
        //     ->where('salesdetails.created_at', '>', $from_date)
        //     ->where('salesdetails.created_at', '<', $to_date)
        //     // ->where($xaxis, $filterByXvalue)
        //     ->groupBy($xaxis)
        //     ->limit($limit)
        //     ->toSql();
        // // dd($from_date, $to_date);

        // return response()->json(['data' => $chartData, 'sqlQuery' => $sqlQuery]);
    }
    public function getChart(Request $request)
    {
        $now = Carbon::now();

        $table_name = $request->input('table_name');
        $xaxis = $request->input('xaxis');
        $yaxis = $request->input('yaxis');
        $limit = $request->input('limit');
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
            ->limit($limit)
            ->get();

        // dd($chartData);
        $sqlQuery = DB::table($table_name)
            ->select($xaxis, DB::raw("sum($yaxis) as $yaxis"))
            ->where('created_at', '>', $from_date)
            ->where('created_at', '<', $to_date)
            // ->where($xaxis, $filterByXvalue)
            ->groupBy($xaxis)
            ->limit($limit)
            ->toSql();

        return response()->json(['data' => $chartData, 'sqlQuery' => $sqlQuery]);
    }
    // Get all table names from the database schema
    public function getTableList()
    {
        // working 1
        $tables = Schema::getConnection()->getDoctrineSchemaManager()->listTableNames();
        // working 2
        // $tables = DB::select('SHOW TABLES');
        // working 3
        // $tables = Schema::getAllTables();
        // Return the list of tables as JSON response
        return response()->json(['tables' => $tables]);
    }
    public function getTableColumns($tableName)
    {
        // Check if the table exists
        if (Schema::hasTable($tableName)) {
            // Get columns for the selected table
            $columns = Schema::getColumnListing($tableName);

            // Return the columns as JSON response
            return response()->json(['columns' => $columns]);
        } else {
            // Return error response if the table doesn't exist
            return response()->json(['error' => 'Table not found'], 404);
        }
    }
    // ######################## charts API created by jatin (ends here) ######################## //
    // ######################## charts API created by jatin (ends here) ######################## //

}
