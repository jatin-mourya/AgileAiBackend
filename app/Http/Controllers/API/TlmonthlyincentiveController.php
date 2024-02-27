<?php

namespace App\Http\Controllers\API;

// //use DB   
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Tlmonthlyincentive;

class TlmonthlyincentiveController extends Controller
{

    //12-03-2023

    public function index()
    {
        $newTLM = Tlmonthlyincentive::all();
        $newTLM = DB::table('tl_monthly_incentive')
            ->join('users', 'users.user_id', '=', 'tl_monthly_incentive.teamleader_id')
            ->join('teams', 'teams.team_id', '=', 'tl_monthly_incentive.team_id')
            ->select('users.firstname', 'users.middlename', 'users.lastname', 'teams.teamname', 'tl_monthly_incentive.*')
            ->get();
        return response()->json($newTLM);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create(Request $request)
    {
        $newTLM = new Tlmonthlyincentive([
            'teamleader_id' => $request->get('teamleader_id'),
            'team_id' => $request->get('team_id'),
            'no_tm' => $request->get('no_tm'),
            'no_active_tm' => $request->get('no_active_tm'),
            'total_sales' => $request->get('total_sales'),

            'performance' => $request->get('performance'),
            'tl_eligibility_ince' => $request->get('tl_eligibility_ince'),
            'tmi_gpi_ti' => $request->get('tmi_gpi_ti'),
            'tmi_ai_ti' => $request->get('tmi_ai_ti'),
            'tmi_pi_ti' => $request->get('tmi_pi_ti'),

            'tli_mgpi_tl' => $request->get('tli_mgpi_tl'),
            'tli_ai_tl' => $request->get('tli_ai_tl'),
            'tli_pi_tl' => $request->get('tli_pi_tl'),
            'mp_incentives' => $request->get('mp_incentives'),
            'mpd_incentives' => $request->get('mpd_incentives'),

            'mp_eligibility' => $request->get('mp_eligibility'),
            'ince_feq' => $request->get('ince_feq'),
            'remark' => $request->get('remark'),
            'quater' => $request->get('quater'),
            'YearMonth' => $request->get('YearMonth'),

            'from_date' => $request->get('from_date'),
            'to_date' => $request->get('to_date'),

            'paid_amt' => $request->get('paid_amt'),
            'ince_type' => $request->get('ince_type'),
        ]);
        return response()->json($newTLM);

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
            'teamleader_id' => 'required',
            'team_id' => 'required',
            //  'no_tm' => 'required',
            //  'no_active_tm' => 'required',
            //  'total_sales' => 'required',

            //  'performance' => 'required',
            //  'tl_eligibility_ince' => 'required',
            //  'tmi_gpi_ti' => 'required',
            //  'tmi_ai_ti' => 'required',
            //  'tmi_pi_ti' => 'required',

            //  'tli_mgpi_tl' => 'required',
            //  'tli_ai_tl' => 'required',
            //  'tli_pi_tl' => 'required',
            //  'mp_incentives' => 'required',
            //  'mpd_incentives' => 'required',

            //  'mp_eligibility' => 'required',
            //  'ince_feq' => 'required',
            //  'remark' => 'required',
            'quater' => 'required',
            'YearMonth' => 'required',

            'from_date' => 'required',
            'to_date' => 'required',
            //  'paid_amt' => '',
            // 'ince_type' => '',

        ]);

        $newTLM = new Tlmonthlyincentive([
            'teamleader_id' => $request->get('teamleader_id'),
            'team_id' => $request->get('team_id'),
            'no_tm' => $request->get('no_tm'),
            'no_active_tm' => $request->get('no_active_tm'),
            'total_sales' => $request->get('total_sales'),

            'performance' => $request->get('performance'),
            'tl_eligibility_ince' => $request->get('tl_eligibility_ince'),
            'tmi_gpi_ti' => $request->get('tmi_gpi_ti'),
            'tmi_ai_ti' => $request->get('tmi_ai_ti'),
            'tmi_pi_ti' => $request->get('tmi_pi_ti'),

            'tli_mgpi_tl' => $request->get('tli_mgpi_tl'),
            'tli_ai_tl' => $request->get('tli_ai_tl'),
            'tli_pi_tl' => $request->get('tli_pi_tl'),
            'mp_incentives' => $request->get('mp_incentives'),
            'mpd_incentives' => $request->get('mpd_incentives'),

            'mp_eligibility' => $request->get('mp_eligibility'),
            'ince_feq' => $request->get('ince_feq'),
            'remark' => $request->get('remark'),
            'quater' => $request->get('quater'),
            'YearMonth' => $request->get('YearMonth'),

            'from_date' => $request->get('from_date'),
            'to_date' => $request->get('to_date'),

            'paid_amt' => $request->get('paid_amt'),
            'ince_type' => $request->get('ince_type'),
        ]);

        $newTLM->save();


        return response()->json($newTLM);

        // return ('message','Success! You have added data successfully.');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($ince_id)
    {
        $newTLM = Tlmonthlyincentive::findOrFail($ince_id);
        return response()->json($newTLM);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $team_id)
    {
        $newTLM = Tlmonthlyincentive::findOrFail($team_id);

        $request->validate([
            'teamleader_id' => 'required',
            'team_id' => 'required',
            //  'no_tm' => 'required',
            //  'no_active_tm' => 'required',
            //  'total_sales' => 'required',

            //  'performance' => 'required',
            //  'tl_eligibility_ince' => 'required',
            //  'tmi_gpi_ti' => 'required',
            //  'tmi_ai_ti' => 'required',
            //  'tmi_pi_ti' => 'required',

            //  'tli_mgpi_tl' => 'required',
            //  'tli_ai_tl' => 'required',
            //  'tli_pi_tl' => 'required',
            //  'mp_incentives' => 'required',
            //  'mpd_incentives' => 'required',

            //  'mp_eligibility' => 'required',
            //  'ince_feq' => 'required',
            //  'remark' => 'required',
            'quater' => 'required',
            'YearMonth' => 'required',

            'from_date' => 'required',
            'to_date' => 'required',
        ]);

        $newTLM->teamleader_id = $request->get('teamleader_id');
        $newTLM->team_id = $request->get('team_id');
        $newTLM->no_tm = $request->get('no_tm');
        $newTLM->no_active_tm = $request->get('no_active_tm');
        $newTLM->total_sales = $request->get('total_sales');

        $newTLM->performance = $request->get('performance');
        $newTLM->tl_eligibility_ince = $request->get('tl_eligibility_ince');
        $newTLM->tmi_gpi_ti = $request->get('tmi_gpi_ti');
        $newTLM->tmi_ai_ti = $request->get('tmi_ai_ti');
        $newTLM->tmi_pi_ti = $request->get('tmi_pi_ti');

        $newTLM->tli_mgpi_tl = $request->get('tli_mgpi_tl');
        $newTLM->tli_ai_tl = $request->get('tli_ai_tl');
        $newTLM->tli_pi_tl = $request->get('tli_pi_tl');
        $newTLM->mp_incentives = $request->get('mp_incentives');
        $newTLM->mpd_incentives = $request->get('mpd_incentives');

        $newTLM->mp_eligibility = $request->get('mp_eligibility');
        $newTLM->ince_feq = $request->get('ince_feq');
        $newTLM->remark = $request->get('remark');
        $newTLM->quater = $request->get('quater');
        $newTLM->YearMonth = $request->get('YearMonth');

        $newTLM->from_date = $request->get('from_date');
        $newTLM->to_date = $request->get('to_date');


        $newTLM->save();

        return response()->json($newTLM);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($team_id)
    {
        $newTLM = Tlmonthlyincentive::findOrFail($team_id);
        $newTLM->delete();

        return response()->json($newTLM::all());
    }

    //get active user from teamleader
    public function getActiveTL()
    {
        $data = DB::table('team_leaders')
            ->select('team_id', 'user_id', 'team_leader_name')
            ->where('status', '=', 1)
            ->groupBy('team_id', 'user_id', 'team_leader_name')
            ->get();
        return response()->json($data);
    }


    public function getTLMLastUser()
    {
        $data = DB::table('tl_monthly_incentive')
            ->select('*')
            ->orderBy('ince_id', 'desc')
            ->limit(1)
            ->get();
        return response()->json($data);
    }


    //16-03-2023 only one function
    public function getTLUserId($u_id)
    {
        $data = DB::table('teamdetails')
            ->select('teamdetails.team_id', 'team_leaders.user_id')
            ->rightJoin('team_leaders', 'teamdetails.team_leader_name', '=', 'team_leaders.team_leader_name')
            ->where('teamdetails.user_id', '=', $u_id)
            ->get();
        return response()->json($data);
    }


    //16-03-2023 filter by month also
    // public function getUsersUTLId($t_id){
    //     $data=DB::table('teamdetails')
    //     ->select('*')
    //     ->rightJoin('tbl_monthly_incentive','teamdetails.user_id','=','tbl_monthly_incentive.user_id')
    //     ->where('team_id','=',$t_id)
    //     ->where('status','=',1)
    //     ->get();
    //     return response()->json($data);
    // }


    public function getUsersUTLId(Request $request)
    {
        $t_id = $request->get('t_id');
        $YearMonth = $request->get('YearMonth');

        $data = DB::table('teamdetails')
            ->select('*')
            ->rightJoin('tbl_monthly_incentive', 'teamdetails.user_id', '=', 'tbl_monthly_incentive.user_id')
            ->where('teamdetails.team_id', '=', $t_id)
            ->where('teamdetails.status', '=', 1)
            ->where('tbl_monthly_incentive.YearMonth', '=', $YearMonth)
            ->get();
        return response()->json($data);
    }




    public function getIncOfAllUsers(Request $request)
    {
        $users_arr = $request->get('users_arr');
        $yearm = $request->get('yearm');
        $data = DB::table('tbl_monthly_incentive')
            ->select('*')
            ->whereIn('user_id', $users_arr)
            ->where('YearMonth', $yearm)
            ->get();
        return response()->json($data);
    }


    //13-03-2023
    function updatetlmi(Request $request)
    {
        $team_id = $request->get('team_id');
        $monthly_inc = $request->get('monthly_inc');
        $from_date = $request->get('from_date');
        //dd($resignation_date, $user_id);
        $data = DB::table('tl_monthly_incentive')
            ->where('teamleader_id', $team_id)
            ->where('from_date', $from_date)
            ->update(['monthly_inc' => $monthly_inc]);
        return response()->json($data);
    }


    //15-03-2023
    function getTidTl(Request $request)
    {
        $team_id = $request->get('team_id');
        $data = DB::table('team_leaders')
            ->join('users', 'users.user_id', '=', 'team_leaders.user_id')
            ->select('team_leaders.team_leader_id', 'team_leaders.team_id', 'team_leaders.user_id', 'users.firstname', 'users.middlename', 'users.lastname')
            ->where('team_id', '=', $team_id)
            ->get();
        return response()->json($data);
    }

    function getTLData(Request $request)
    {
        $team_leader_id = $request->get('team_leader_id');
        $data = DB::table('tl_monthly_incentive')
            ->join('users', 'users.user_id', '=', 'tl_monthly_incentive.teamleader_id')
            ->join('teams', 'teams.team_id', '=', 'tl_monthly_incentive.team_id')
            ->select('users.firstname', 'users.middlename', 'users.lastname', 'teams.teamname', 'tl_monthly_incentive.*')
            ->where('teamleader_id', '=', $team_leader_id)
            ->get();
        return response()->json($data);
    }


    //new api not update in route
    public function addTlMonthlyIncentive(Request $request)
    {
        $teamleader_id = $request->get('teamleader_id');
        $team_id = $request->get('team_id');
        $no_tm = $request->get('no_tm');
        $no_active_tm = $request->get('no_active_tm');
        $total_sales = $request->get('total_sales');
        $performance = $request->get('performance');
        $tl_eligibility_ince = $request->get('tl_eligibility_ince');
        $YearMonth = $request->get('YearMonth');

        $tmi_gpi_ti = $request->get('tmi_gpi_ti');
        $tmi_ai_ti = $request->get('tmi_ai_ti');
        $tmi_pi_ti = $request->get('tmi_pi_ti');

        $tli_mgpi_tl = $request->get('tli_mgpi_tl');
        $tli_ai_tl = $request->get('tli_ai_tl');
        $tli_pi_tl = $request->get('tli_pi_tl');



        $data = DB::table('tl_monthly_incentive')
            ->where('team_id', '=', $team_id)
            ->where('teamleader_id', '=', $teamleader_id)
            ->where('YearMonth', '=', $YearMonth)
            ->update([
                'no_tm' => $no_tm,
                'no_active_tm' => $no_active_tm,
                'total_sales' => $total_sales,
                'performance' => $performance,
                'tl_eligibility_ince' => $tl_eligibility_ince,
                "tmi_gpi_ti" => $tmi_gpi_ti,
                "tmi_ai_ti" => $tmi_ai_ti,
                "tmi_pi_ti" => $tmi_pi_ti,
                "tli_mgpi_tl" => $tli_mgpi_tl,
                "tli_ai_tl" => $tli_ai_tl,
                "tli_pi_tl" => $tli_pi_tl
            ]);

        return response()->json($data);
    }


    //13-04-2023 get only booked deal not a calcel deal

    public function getAllUserData(Request $request)
    {
        $users_arr = $request->get('users_arr');
        $datestart = $request->get('datestart');
        $dateend = $request->get('dateend');
        $teamid = $request->get('teamid');

        $data = DB::table('salesdetails')
            ->select('*')
            ->whereBetween('booking_date', ["$datestart", "$dateend"])
            ->whereIn('sourcing_emp_id', $users_arr)
            ->where('team_id', '=', $teamid)
            ->where('deal_status_id', '=', 1)
            ->get();
        return response()->json($data);
    }


    //12-04-2023 tl monthly incentive
    public function getUserUTLIdA(Request $request)
    {
        $t_id = $request->get('t_id');
        $YearMonth = $request->get('YearMonth');
        $user_id = $request->get('user_id');

        $data = DB::table('teamdetails')
            ->select('*')
            ->rightJoin('tbl_monthly_incentive', 'teamdetails.user_id', '=', 'tbl_monthly_incentive.user_id')
            ->where('teamdetails.team_id', '=', $t_id)
            ->where('teamdetails.status', '=', 1)
            ->where('tbl_monthly_incentive.user_id', '=', $user_id)
            ->where('tbl_monthly_incentive.YearMonth', '=', $YearMonth)
            ->get();
        return response()->json($data);
    }

    public function getMTL(Request $request)
    {
        $t_id = $request->get('t_id');
        $tl_id = $request->get('tl_id');
        $YearMonth = $request->get('YearMonth');

        $data = DB::table('tl_monthly_incentive')
            ->select('*')
            ->where('team_id', '=', $t_id)
            ->where('teamleader_id', '=', $tl_id)
            ->where('YearMonth', '=', $YearMonth)
            ->get();
        return response()->json($data);
    }


    //03-05-2023
    public function getDueTLMR(Request $request)
    {
        $t_id = $request->get('t_id');
        $tl_id = $request->get('tl_id');

        $data = DB::table('tl_monthly_incentive')
            ->where('tl_monthly_incentive.team_id', '=', $t_id)
            ->where('tl_monthly_incentive.teamleader_id', '=', $tl_id)
            ->where('tl_monthly_incentive.tl_eligibility_ince', '=', 1)
            ->select('tl_monthly_incentive.ince_id', 'tl_monthly_incentive.teamleader_id', 'tl_monthly_incentive.ince_type', 'tl_monthly_incentive.tli_pi_tl as incentive', 'tl_monthly_incentive.from_date', 'tl_monthly_incentive.to_date', 'tl_monthly_incentive.paid_amt', 'tl_monthly_incentive.pending_amt', )
            ->get();
        // dd($data);
        return response()->json($data);
    }

    public function getDueTLQR(Request $request)
    {
        $t_id = $request->get('t_id');
        $tl_id = $request->get('tl_id');

        $data = DB::table('tl_quarterly_incentive')
            ->where('tl_quarterly_incentive.teamleader_id', '=', $tl_id)
            ->where('tl_quarterly_incentive.team_id', '=', $t_id)
            ->where('tl_quarterly_incentive.tl_quarterly_eligible', '=', 1)
            ->select('tl_quarterly_incentive.ince_id', 'tl_quarterly_incentive.teamleader_id', 'tl_quarterly_incentive.ince_type', 'tl_quarterly_incentive.quarterly_inc as incentive', 'tl_quarterly_incentive.from_date', 'tl_quarterly_incentive.to_date', 'tl_quarterly_incentive.paid_amt', 'tl_quarterly_incentive.pending_amt')
            ->get();
        return response()->json($data);
    }

    public function getDueTLHYR(Request $request)
    {
        $t_id = $request->get('t_id');
        $tl_id = $request->get('tl_id');

        $data = DB::table('tl_halfyear_incentive')
            ->where('tl_halfyear_incentive.teamleader_id', '=', $tl_id)
            ->where('tl_halfyear_incentive.team_id', '=', $t_id)
            ->where('tl_halfyear_incentive.tl_halfyear_eligible', '=', 1)
            ->select('tl_halfyear_incentive.ince_id', 'tl_halfyear_incentive.teamleader_id', 'tl_halfyear_incentive.ince_type', 'tl_halfyear_incentive.halfyear_inc as incentive', 'tl_halfyear_incentive.from_date', 'tl_halfyear_incentive.to_date', 'tl_halfyear_incentive.paid_amt', 'tl_halfyear_incentive.pending_amt')
            ->get();
        return response()->json($data);
    }

    public function getDueTLYR(Request $request)
    {
        $t_id = $request->get('t_id');
        $tl_id = $request->get('tl_id');

        $data = DB::table('tl_yearly_incentive')
            ->where('tl_yearly_incentive.teamleader_id', '=', $tl_id)
            ->where('tl_yearly_incentive.team_id', '=', $t_id)
            ->where('tl_yearly_incentive.tl_yearly_eligible', '=', 1)
            ->select('tl_yearly_incentive.ince_id', 'tl_yearly_incentive.teamleader_id', 'tl_yearly_incentive.ince_type', 'tl_yearly_incentive.yearly_inc as incentive', 'tl_yearly_incentive.from_date', 'tl_yearly_incentive.to_date', 'tl_yearly_incentive.paid_amt', 'tl_yearly_incentive.pending_amt', )
            ->get();
        return response()->json($data);
    }
}
