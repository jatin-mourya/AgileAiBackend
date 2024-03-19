<?php

use App\Console\Commands\DemoCron;
use App\Http\Controllers\API\AttendanceController;
//use App\Http\Controllers\API\NewusersController;
use App\Http\Controllers\API\B2binvoiceController;
use App\Http\Controllers\API\BookingStatusController;
use App\Http\Controllers\API\builderGroupController;
use App\Http\Controllers\API\ChannelpartnerController;
use App\Http\Controllers\API\ClientdetailsController;
use App\Http\Controllers\API\ClientpaymentscheduleController;
use App\Http\Controllers\API\ConsultancyFessController;
use App\Http\Controllers\API\CreditdetailsController;
use App\Http\Controllers\API\CreditmultiController;
use App\Http\Controllers\API\CreditNoteController;
use App\Http\Controllers\API\DealdetailsController;
use App\Http\Controllers\API\DebtorcompanydetController;
use App\Http\Controllers\API\DesignationsController;
use App\Http\Controllers\API\EmpCommentsController;
use App\Http\Controllers\API\EmpStatusController;
use App\Http\Controllers\API\GroupsController;
use App\Http\Controllers\API\GstFillingDetailsController;
use App\Http\Controllers\API\GstjsonController;
use App\Http\Controllers\API\Gstr2aController;
use App\Http\Controllers\API\Gstr_3b;
use App\Http\Controllers\API\HalfyearincentiveController;
use App\Http\Controllers\API\ImageController;
use App\Http\Controllers\API\IncentiveController;
use App\Http\Controllers\API\IncentiverangeController;
use App\Http\Controllers\API\InvoicecommentsController;
use App\Http\Controllers\API\InvoiceController;
use App\Http\Controllers\API\InvoicedetidsController;
use App\Http\Controllers\API\InvoiceMultiController;
use App\Http\Controllers\API\Inv_statusController;
use App\Http\Controllers\API\LeadsgivenController;
use App\Http\Controllers\API\LeadsourceController;
use App\Http\Controllers\API\modelController;

////////// SALARY MODULE ///////////////////////
use App\Http\Controllers\API\ModulefieldsController;
use App\Http\Controllers\API\ModulesController;
use App\Http\Controllers\API\MonthController;
use App\Http\Controllers\API\MonthlyIncentiveController;
use App\Http\Controllers\API\MonthsController;
use App\Http\Controllers\API\PayoutStatusController;

////////// INVOICES MODULE ////////////////
use App\Http\Controllers\API\PayvoucherController;
use App\Http\Controllers\API\PayvoucherDetailsController;
use App\Http\Controllers\API\PayvouchertlController;
use App\Http\Controllers\API\PayvouchertlDetailsController;
use App\Http\Controllers\API\ProjectallocationsController;
use App\Http\Controllers\API\ProjectsController;
use App\Http\Controllers\API\QuarterlyIncentiveController;
use App\Http\Controllers\API\ReceiptDetailsController;
use App\Http\Controllers\API\RegionsController;

/////////// GST R1 //////////////////

use App\Http\Controllers\API\ReportsController;
use App\Http\Controllers\API\ReportUserController;
use App\Http\Controllers\API\reraController;
use App\Http\Controllers\API\RoleAccessController;
use App\Http\Controllers\API\rolepermissionController;
use App\Http\Controllers\API\RolesController;
use App\Http\Controllers\API\Salary\AdvanceemiController;
use App\Http\Controllers\API\Salary\AdvancesalaryController;
use App\Http\Controllers\API\Salary\MonthlySalary1Controller;
use App\Http\Controllers\API\Salary\MonthlysalaryController;
use App\Http\Controllers\API\Salary\MonthlytargetController;
use App\Http\Controllers\API\Salary\SalarypackageController;
use App\Http\Controllers\API\SalescommentsController;
use App\Http\Controllers\API\SalesdetailsController;
use App\Http\Controllers\API\SalesdocumentsController;
use App\Http\Controllers\API\sharedRuleController;
use App\Http\Controllers\API\sharingaccessController;
use App\Http\Controllers\API\SubprojectsController;

//12-3-2023
use App\Http\Controllers\API\SubregionsController;
use App\Http\Controllers\API\TdsRatecontroller;
use App\Http\Controllers\API\TeamdetailsController;
use App\Http\Controllers\API\TeamleadersController;
use App\Http\Controllers\API\TeamsController;
//22-04-2023
use App\Http\Controllers\API\TeamStatusController;
use App\Http\Controllers\API\TicketsController;
//04-05-2023
use App\Http\Controllers\API\TlhalfyearincentiveController;
use App\Http\Controllers\API\TlincentivestructureController;
///role-based-permission////
use App\Http\Controllers\API\TlmonthlyincentiveController;
use App\Http\Controllers\API\TlquarterlyincentiveController;
use App\Http\Controllers\API\TlyearlyincentiveController;
use App\Http\Controllers\API\UsergroupController;
use App\Http\Controllers\API\UsersController;
use App\Http\Controllers\API\WalkindealsController;
use App\Http\Controllers\API\WeeklyleadsController;
use App\Http\Controllers\API\YearIncentiveController;
use App\Http\Controllers\ChartsController;
use App\Http\Controllers\invoiceTypesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('roles', RolesController::class);

//Route::apiResource('newusers', NewusersController::class);

Route::apiResource('groups', GroupsController::class);

Route::apiResource('teams', TeamsController::class);

Route::apiResource('projects', ProjectsController::class);

Route::apiResource('subprojects', SubprojectsController::class);

Route::apiResource('regions', RegionsController::class);

Route::apiResource('subregions', SubregionsController::class);

Route::apiResource('designations', DesignationsController::class);

Route::apiResource('users', UsersController::class);

Route::apiResource('projectallocations', ProjectallocationsController::class);

Route::apiResource('team_status', TeamStatusController::class);

Route::apiResource('team_leaders', TeamleadersController::class);

Route::apiResource('teamdetails', TeamdetailsController::class);

Route::apiResource('emp_status', EmpStatusController::class);

Route::apiResource('debtor_company_det', DebtorcompanydetController::class);

Route::apiResource('emp_comments', EmpCommentsController::class);

// Route::apiResource('emp_documents', EmpDocumentsController::class);

Route::apiResource('clientdetails', ClientdetailsController::class);

Route::apiResource('channelpartner', ChannelpartnerController::class);

Route::apiResource('booking_status', BookingStatusController::class);

Route::apiResource('payout_status', PayoutStatusController::class);

Route::apiResource('leadsource', LeadsourceController::class);

Route::apiResource('salesdetails', SalesdetailsController::class);

Route::apiResource('client_payment_schedule', ClientpaymentscheduleController::class);

Route::apiResource('sales_documents', SalesdocumentsController::class);

Route::apiResource('sales_comments', SalescommentsController::class);

Route::apiResource('invoice_comments', InvoicecommentsController::class);

Route::apiResource('emp_documents', ImageController::class);

Route::apiResource('reports', ReportsController::class);

Route::apiResource('modules', ModulesController::class);

Route::apiResource('module_fields', ModulefieldsController::class);

Route::apiResource('months', MonthsController::class);

//////////////  SALARY MODULE ///////////////////

Route::apiResource('salary_package', SalarypackageController::class);

Route::apiResource('advance_salary', AdvancesalaryController::class);

Route::apiResource('advance_emi_details', AdvanceemiController::class);

Route::apiResource('monthly_target', MonthlytargetController::class);

Route::apiResource('monthly_salary', MonthlysalaryController::class);
// newww
Route::apiResource('monthlysalary1', MonthlySalary1Controller::class);

Route::apiResource('monthly_salary1', MonthlySalary1Controller::class);

Route::apiResource('attendance', AttendanceController::class);

/////////////  INvOICES MODULE /////////////////

Route::apiResource('invoice', InvoiceController::class);
Route::apiResource('receiptdetails', ReceiptDetailsController::class);
Route::apiResource('credit_note', CreditNoteController::class);
Route::apiResource('gst_fillingdetails', GstFillingDetailsController::class);

/////////// GST R1 //////////////////
Route::apiResource('gst_json', GstjsonController::class);
Route::apiResource('gstr2a', Gstr2aController::class);
Route::apiResource('b2binvoices', B2binvoiceController::class);

///////////////////////// GSR3B AAPI    ////////////////////
Route::apiResource('gstr3b', Gstr_3b::class);
Route::apiResource('month', MonthController::class);
Route::apiResource('incentives', IncentiveController::class);
Route::apiResource('monthlyince', MonthlyIncentiveController::class);
Route::apiResource('incentiverange', IncentiverangeController::class);
Route::apiResource('tds_rate', TdsRatecontroller::class);
Route::apiResource('dealdetail', DealdetailsController::class);

Route::apiResource('quarterly_incentive', QuarterlyIncentiveController::class);
Route::apiResource('halfyear_incentive', HalfyearincentiveController::class);
Route::apiResource('year_incentive', YearIncentiveController::class);
Route::apiResource('Walkindeals', WalkindealsController::class);

Route::apiResource('leadsgiven', LeadsgivenController::class);
Route::apiResource('weeklyleads', WeeklyleadsController::class);
Route::apiResource('consultancyfees', ConsultancyFessController::class);
Route::apiResource('handle', DemoCron::class);

/////////////tl_monthly_incentive///////////
Route::apiResource('tl_monthly_incentive', TlmonthlyincentiveController::class);
Route::apiResource('tl_quarterly_incentive', TlquarterlyincentiveController::class);
Route::apiResource('tl_incentive_structure', TlincentivestructureController::class);
Route::apiResource('tl_halfyear_incentive', TlhalfyearincentiveController::class);
Route::apiResource('tl_yearly_incentive', TlyearlyincentiveController::class);
/////////////tl_monthly_incentive///////////
/////////////payvoucher///////////
Route::apiResource('payvoucher', PayvoucherController::class);
Route::apiResource('payvoucherdetails', PayvoucherDetailsController::class);
Route::apiResource('payvouchertl', PayvouchertlController::class);
Route::apiResource('payvouchertldetails', PayvouchertlDetailsController::class);
/////////////payvoucher///////////

//////role-permission////
// Route::apiResource('tabs', TabsController::class);
Route::apiResource('rolepermission', rolepermissionController::class);
Route::apiResource('RoleAccess', RoleAccessController::class);
Route::apiResource('sharedRule', sharedRuleController::class);
Route::apiResource('builderGroup', builderGroupController::class);
Route::apiResource('rera', reraController::class);
Route::apiResource('reportuser', ReportUserController::class);
Route::apiResource('sharing_access', sharingaccessController::class);
Route::apiResource('Usergroup', UsergroupController::class);
Route::apiResource('creditmulti', CreditmultiController::class);
Route::apiResource('creditdetails', CreditdetailsController::class);
Route::apiResource('modelrole', modelController::class);

Route::group([

    'middleware' => 'api',

], function ($router) {
    Route::get('/getDisbursement1/{id}', [App\Http\Controllers\API\InvoiceMultiController::class, 'getDisbursement1'])->name('getDisbursement1');

    Route::get('/getDisbursement', [App\Http\Controllers\API\InvoiceMultiController::class, 'getDisbursement'])->name('getDisbursement');

    Route::patch('/updateReraDataForsubProject/{subproject_id}', [App\Http\Controllers\API\SubprojectsController::class, 'updateReraDataForsubProject'])->name('updateReraDataForsubProject');

    Route::get('/showRera1/{project_id}', [App\Http\Controllers\API\SubprojectsController::class, 'showRera1'])->name('showRera1');

    Route::post('/reradata1', [App\Http\Controllers\API\SubprojectsController::class, 'reradata1'])->name('reradata1');

    Route::patch('/updateReraDataForProject/{project_id}', [App\Http\Controllers\API\ProjectsController::class, 'updateReraDataForProject'])->name('updateReraDataForProject');
    Route::get('/showRera/{project_id}', [App\Http\Controllers\API\ProjectsController::class, 'showRera'])->name('showRera');
    Route::post('/reradata', [App\Http\Controllers\API\ProjectsController::class, 'reradata'])->name('reradata');

    Route::get('/getStatusEnumValues', [App\Http\Controllers\API\builderGroupController::class, 'getStatusEnumValues'])->name('getStatusEnumValues');

    //12-05-2023
    Route::get('/getmaactiveuser', [App\Http\Controllers\API\UsersController::class, 'getMAActiveuser'])->name('getMAActiveuser');
    Route::get('/getmaactivetl', [App\Http\Controllers\API\UsersController::class, 'getMAActivetl'])->name('getMAActivetl');
    //crm lead data//
    Route::get('/monthleadlist/{month}', [App\Http\Controllers\API\LeadController::class, 'monthleadlist'])->name('monthleadlist');
    Route::get('/userleadlist/{user_name}', [App\Http\Controllers\API\LeadController::class, 'userleadlist'])->name('userleadlist');
    Route::get('/teamleaderlist/{teamleader_name}', [App\Http\Controllers\API\LeadController::class, 'teamleaderlist'])->name('teamleaderlist');
    Route::get('/dateleaderlist/{date}', [App\Http\Controllers\API\LeadController::class, 'dateleaderlist'])->name('dateleaderlist');
    //   Route::get('/handle', [App\Console\Commands\DemoCron::class,'handle'])->name('handle');
    Route::get('/leadprojectwise', [App\Http\Controllers\API\ProjectController::class, 'leadprojectwise'])->name('leadprojectwise');
    // Route::get('/leadDatereport', [App\Http\Controllers\API\DateLeadController::class,'leadDatereport'])->name('leadDatereport');
    // Route::get('/leadDatewise', [App\Http\Controllers\API\DateLeadController::class,'leadDatewise'])->name('leadDatewise');
    Route::get('/leadteamwise', [App\Http\Controllers\API\LeadController::class, 'leadteamwise'])->name('leadteamwise');
    Route::get('/projectreport', [App\Http\Controllers\API\ProjectController::class, 'projectreport'])->name('projectreport');
    Route::get('/leadreport', [App\Http\Controllers\API\LeadController::class, 'leadreport'])->name('leadreport');
    //consultancy-fees//

    Route::get('/getUserDesgination/{designation_id}', [App\Http\Controllers\API\ConsultancyFessController::class, 'getUserDesgination'])->name('getUserDesgination');
    Route::get('/getCFCValue', [App\Http\Controllers\API\ConsultancyFessController::class, 'getCFCValue'])->name('getCFCValue');
    Route::get('/getSelectedDesignation/{d_id}', [App\Http\Controllers\API\ConsultancyFessController::class, 'getSelectedDesignation'])->name('getSelectedDesignation');
    //29-12-2022
    Route::get('/userTLRH/{u_id}', [App\Http\Controllers\API\ConsultancyFessController::class, 'userTLRH'])->name('userTLRH');
    //1-20-2023
    Route::get('/userTLRH2/{u_id}/{startdate}/{enddate}', [App\Http\Controllers\API\ConsultancyFessController::class, 'userTLRH2'])->name('userTLRH2');
    Route::get('/getUsersCF', [App\Http\Controllers\API\ConsultancyFessController::class, 'getUsersCF'])->name('getUsersCF');
    Route::get('/getUsersDesignationNo/{uu_id}', [App\Http\Controllers\API\ConsultancyFessController::class, 'getUsersDesignationNo'])->name('getUsersDesignationNo');

    //03-01-2022
    Route::get('/updateTable', [App\Http\Controllers\API\ConsultancyFessController::class, 'updateTable'])->name('updateTable');
    Route::post('/updatedateteamcf', [App\Http\Controllers\API\ConsultancyFessController::class, 'updatedateteamcf'])->name('updatedateteamcf');
    Route::post('/updatedateteamcfdelete', [App\Http\Controllers\API\ConsultancyFessController::class, 'updatedateteamcfdelete'])->name('updatedateteamcfdelete');

    //16-01-2023
    Route::get('/getcfvalue/{sid}', [App\Http\Controllers\API\ConsultancyFessController::class, 'getcfvalue'])->name('getcfvalue');

    //17-01-2023
    Route::get('/getsalescfvalue/{cv}/{pv}/{pid}/{lid}', [App\Http\Controllers\API\ConsultancyFessController::class, 'getsalescfvalue'])->name('getsalescfvalue');

    //17-01-2023
    Route::get('/newrecordsaledetails', [App\Http\Controllers\API\ConsultancyFessController::class, 'newrecordsaledetails'])->name('newrecordsaledetails');
    Route::get('/updaterecordsaledetails', [App\Http\Controllers\API\ConsultancyFessController::class, 'updaterecordsaledetails'])->name('updaterecordsaledetails');

    //18-1-2023
    Route::post('/updatesaleids', [App\Http\Controllers\API\ConsultancyFessController::class, 'updatesaleids'])->name('updatesaleids');
    Route::get('/getsaledetailsdata', [App\Http\Controllers\API\ConsultancyFessController::class, 'getsaledetailsdata'])->name('getsaledetailsdata');
    // Route::post('/projectslist', [App\Http\Controllers\API\ProjectsController::class,'projectslist'])->name('projectslist');

    Route::get('/getRegionsOfSubregion/{region_id}', [App\Http\Controllers\API\SubregionsController::class, 'getSubregionOfRegion'])->name('getSubregion');
    Route::post('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('login');
    Route::post('/signup', [App\Http\Controllers\AuthController::class, 'signup'])->name('signup');
    Route::get('/dropdownlist', [App\Http\Controllers\API\SalesdetailsController::class, 'getTableColumns'])->name('getTableColumns');
    Route::get('/getSalesCount', [App\Http\Controllers\API\SalesdetailsController::class, 'getSalesCount'])->name('getSalesCount');
    Route::get('/getApply/{data}', [App\Http\Controllers\API\SalesdetailsController::class, 'getApply'])->name('getApply');
    Route::get('/generate/{id}', [App\Http\Controllers\API\ReportsController::class, 'generatereports'])->name('generatereports');
    Route::get('/getid', [App\Http\Controllers\API\ReportsController::class, 'getid'])->name('getid');
    Route::get('/fields', [App\Http\Controllers\API\ModulefieldsController::class, 'fields'])->name('fields');
    Route::get('/calculation', [App\Http\Controllers\API\ReportsController::class, 'calculation'])->name('calculation');
    Route::get('/calsum/{id}', [App\Http\Controllers\API\ReportsController::class, 'calsum'])->name('calsum');
    Route::get('/calavrg/{id}', [App\Http\Controllers\API\ReportsController::class, 'calavrg'])->name('calavrg');
    Route::get('/getteam/{id}', [App\Http\Controllers\API\TeamleadersController::class, 'getteam'])->name('getteam');
    Route::get('/invoicejoin/{id}', [App\Http\Controllers\API\GstjsonController::class, 'invoicejoin'])->name('invoicejoin');
    Route::get('/getSubproject/{id}', [App\Http\Controllers\API\SubprojectsController::class, 'getSubproject'])->name('getSubproject');
    Route::get('/getSalarypackageData/{id}', [App\Http\Controllers\API\Salary\SalarypackageController::class, 'getSalarypackageData'])->name('getSalarypackageData');

    ///////////////////////   for multiple client in invoice/////////////

    Route::get('/getUser/{id}', [App\Http\Controllers\API\UsersController::class, 'getUser'])->name('getUser');
    Route::get('/getCgst/{id}', [App\Http\Controllers\API\InvoiceController::class, 'getCgst'])->name('getCgst');
    Route::get('/getsalarybyuser_id/{id}', [App\Http\Controllers\API\Salary\MonthlytargetController::class, 'getsalarybyuser_id'])->name('getsalarybyuser_id');
    Route::get('/getReceivableamt/{id}', [App\Http\Controllers\API\InvoiceController::class, 'getReceivableamt'])->name('getReceivableamt');
    Route::get('/getclientid/{id}', [App\Http\Controllers\API\InvoiceController::class, 'getclientid'])->name('getclientid');
    Route::get('/getlastid', [App\Http\Controllers\API\InvoiceController::class, 'getlastid'])->name('getlastid');
    Route::get('/getclientid2/{id}', [App\Http\Controllers\API\InvoiceMultiController::class, 'getclientid2'])->name('getclientid2');

    // GSRT1 API
    Route::get('/jsonmonthjoin', [App\Http\Controllers\API\GstjsonController::class, 'jsonmonthjoin'])->name('jsonmonthjoin');
    Route::get('/invmonthjoin', [App\Http\Controllers\API\GstjsonController::class, 'invmonthjoin'])->name('invmonthjoin');
    Route::post('/jsonupload', [App\Http\Controllers\API\GstjsonController::class, 'jsonupload'])->name('jsonupload');
    Route::post('/updateCreate', [App\Http\Controllers\API\GstjsonController::class, 'updateCreate'])->name('updateCreate');

    // GSR2A AND B2B iNVOICE API
    // Route::post('/invoice_comments', [App\Http\Controllers\API\InvoiceController::class,'invoice_comments'])->name('invoice_comments');
    Route::post('/uploadgstr2a', [App\Http\Controllers\API\Gstr2aController::class, 'uploadgstr2a'])->name('uploadgstr2a');
    Route::post('/updateCreate2A', [App\Http\Controllers\API\Gstr2aController::class, 'updateCreate2A'])->name('updateCreate2A');
    Route::post('/updateCreateB2B', [App\Http\Controllers\API\B2binvoiceController::class, 'updateCreateB2B'])->name('updateCreateB2B');
    Route::get('/gstr2amonthj', [App\Http\Controllers\API\Gstr2aController::class, 'gstr2amonthj'])->name('gstr2amonthj');
    Route::get('/b2bmonthj', [App\Http\Controllers\API\Gstr2aController::class, 'b2bmonthj'])->name('b2bmonthj');
    Route::get('/invoicegstr2a/{id}', [App\Http\Controllers\API\Gstr2aController::class, 'invoicegstr2a'])->name('invoicegstr2a');
    Route::get('/showId/{id}', [App\Http\Controllers\API\B2binvoiceController::class, 'showId'])->name('showId');
    // Route::post('/invoice_comments', [App\Http\Controllers\API\InvoicecommentsController::class,'invoice_comments'])->name('invoice_comments');

    // GSR3B AAPI
    Route::post('/updateCreate3B', [App\Http\Controllers\API\Gstr_3b::class, 'updateCreate3B'])->name('updateCreate3B');
    Route::get('/getMonth/{id}', [App\Http\Controllers\API\Gstr_3b::class, 'getMonth'])->name('getMonth');
    Route::post('/in_Maha', [App\Http\Controllers\API\InvoiceController::class, 'in_Maha'])->name('in_Maha');
    Route::post('/out_of_Maha', [App\Http\Controllers\API\InvoiceController::class, 'out_of_Maha'])->name('out_of_Maha');
    Route::post('/in_Maha_pur', [App\Http\Controllers\API\B2binvoiceController::class, 'in_Maha_pur'])->name('in_Maha_pur');
    Route::post('/out_Maha_pur', [App\Http\Controllers\API\B2binvoiceController::class, 'out_Maha_pur'])->name('out_Maha_pur');

    //////////// Incentive ///////////
    // Route::get('/monthlyinceData/{id}', [App\Http\Controllers\API\MonthlyIncentiveController::class,'monthlyinceData'])->name('monthlyinceData');
    // Route::post('/lead_count', [App\Http\Controllers\API\MonthlyIncentiveController::class,'lead_count'])->name('lead_count');
    Route::post('/inceCount', [App\Http\Controllers\API\MonthlyIncentiveController::class, 'inceCount'])->name('inceCount');
    Route::post('/updateCreateInce', [App\Http\Controllers\API\MonthlyIncentiveController::class, 'updateCreateInce'])->name('updateCreateInce');
    Route::get('/inceBusiness', [App\Http\Controllers\API\IncentiverangeController::class, 'inceBusiness'])->name('inceBusiness');
    Route::post('/SourcingData', [App\Http\Controllers\API\MonthlyIncentiveController::class, 'SourcingData'])->name('SourcingData');
    Route::post('/ClosingData', [App\Http\Controllers\API\MonthlyIncentiveController::class, 'ClosingData'])->name('ClosingData');
    // Route::get('/inceCount1', [App\Http\Controllers\API\MonthlyIncentiveController::class,'inceCount1'])->name('inceCount1');
    Route::get('/getUserActive', [App\Http\Controllers\API\UsersController::class, 'getUserActive'])->name('getUserActive');
    // Route::patch('/updateInce', [App\Http\Controllers\API\MonthlyIncentiveController::class,'updateInce'])->name('updateInce');
    Route::post('/update1', [App\Http\Controllers\API\MonthlyIncentiveController::class, 'update1'])->name('update1');
    Route::post('/update2', [App\Http\Controllers\API\MonthlyIncentiveController::class, 'update2'])->name('update2');
    Route::post('/update3', [App\Http\Controllers\API\MonthlyIncentiveController::class, 'update3'])->name('update3');
    Route::post('/update4', [App\Http\Controllers\API\MonthlyIncentiveController::class, 'update4'])->name('update4');
    Route::post('/updatepiC', [App\Http\Controllers\API\MonthlyIncentiveController::class, 'updatepiC'])->name('updatepiC');
    Route::post('/updatepiS', [App\Http\Controllers\API\MonthlyIncentiveController::class, 'updatepiS'])->name('updatepiS');
    Route::post('/invoiceInce', [App\Http\Controllers\API\MonthlyIncentiveController::class, 'invoiceInce'])->name('invoiceInce');
    Route::post('/invoiceInceS', [App\Http\Controllers\API\MonthlyIncentiveController::class, 'invoiceInceS'])->name('invoiceInceS');
    Route::get('/invoiceInceMulti/{id}', [App\Http\Controllers\API\MonthlyIncentiveController::class, 'invoiceInceMulti'])->name('invoiceInceMulti');
    Route::get('/getreceiptdata/{id}', [App\Http\Controllers\API\ReceiptDetailsController::class, 'getreceiptdata'])->name('getreceiptdata');
    Route::post('/upCreReceipt', [App\Http\Controllers\API\ReceiptDetailsController::class, 'upCreReceipt'])->name('upCreReceipt');
    Route::get('/receiptD', [App\Http\Controllers\API\ReceiptDetailsController::class, 'receiptD'])->name('receiptD');
    Route::post('/inceReceiptData', [App\Http\Controllers\API\MonthlyIncentiveController::class, 'inceReceiptData'])->name('inceReceiptData');
    Route::post('/SourSaleInce', [App\Http\Controllers\API\MonthlyIncentiveController::class, 'SourSaleInce'])->name('SourSaleInce');
    Route::post('/CloseSaleInce', [App\Http\Controllers\API\MonthlyIncentiveController::class, 'CloseSaleInce'])->name('CloseSaleInce');
    Route::post('/CloInvoiceInce', [App\Http\Controllers\API\MonthlyIncentiveController::class, 'CloInvoiceInce'])->name('CloInvoiceInce');
    Route::post('/SourInvoiceInce', [App\Http\Controllers\API\MonthlyIncentiveController::class, 'SourInvoiceInce'])->name('SourInvoiceInce');
    Route::post('/SourReceInce', [App\Http\Controllers\API\MonthlyIncentiveController::class, 'SourReceInce'])->name('SourReceInce');
    Route::post('/CloseReceInce', [App\Http\Controllers\API\MonthlyIncentiveController::class, 'CloseReceInce'])->name('CloseReceInce');
    Route::post('/getReceiptClose', [App\Http\Controllers\API\MonthlyIncentiveController::class, 'getReceiptClose'])->name('getReceiptClose');
    Route::post('/getReceiptSou', [App\Http\Controllers\API\MonthlyIncentiveController::class, 'getReceiptSou'])->name('getReceiptSou');
    // Route::get('/CloseSaleInce1', [App\Http\Controllers\API\MonthlyIncentiveController::class,'CloseSaleInce1'])->name('CloseSaleInce1');
    Route::get('/getTeamData/{id}', [App\Http\Controllers\API\MonthlyIncentiveController::class, 'getTeamData'])->name('getTeamData');
    Route::get('/IncenUserwise/{id}', [App\Http\Controllers\API\MonthlyIncentiveController::class, 'IncenUserwise'])->name('IncenUserwise');
    Route::get('/getTeamUsers', [App\Http\Controllers\API\MonthlyIncentiveController::class, 'getTeamUsers'])->name('getTeamUsers');
    Route::get('/invoiceInceS1', [App\Http\Controllers\API\MonthlyIncentiveController::class, 'invoiceInceS1'])->name('invoiceInceS1');

    /////////////////////////////////// Deal Details ///////////////////////
    Route::post('/getteamdetails', [App\Http\Controllers\API\DealdetailsController::class, 'getteamdetails'])->name('getteamdetails');
    Route::post('/getuserdata', [App\Http\Controllers\API\DealdetailsController::class, 'getuserdata'])->name('getuserdata');
    Route::post('/getattendance', [App\Http\Controllers\API\DealdetailsController::class, 'getattendance'])->name('getattendance');
    Route::get('/username', [App\Http\Controllers\API\DealdetailsController::class, 'username'])->name('username');
    Route::get('/userdetails/{id}', [App\Http\Controllers\API\DealdetailsController::class, 'userdetails'])->name('userdetails');
    Route::get('/empdata/{id}', [App\Http\Controllers\API\DealdetailsController::class, 'empdata'])->name('empdata');
    Route::get('/single_user/{id}', [App\Http\Controllers\API\DealdetailsController::class, 'single_user'])->name('single_user');
    Route::get('/username1/{id}', [App\Http\Controllers\API\DealdetailsController::class, 'username1'])->name('username1');
    Route::get('/datedata/{id}', [App\Http\Controllers\API\DealdetailsController::class, 'datedata'])->name('datedata');
    Route::post('/datefilter', [App\Http\Controllers\API\DealdetailsController::class, 'datefilter'])->name('datefilter');
    Route::get('/getuserdetails', [App\Http\Controllers\API\WalkindealsController::class, 'getuserdetails'])->name('getuserdetails');
    Route::get('/teamsorting/{id}/{data}/{data1}', [App\Http\Controllers\API\DealdetailsController::class, 'teamsorting'])->name('teamsorting');
    Route::get('/usersorting/{id}/{data}/{data1}', [App\Http\Controllers\API\DealdetailsController::class, 'usersorting'])->name('usersorting');
    Route::get('/getuserdetails', [App\Http\Controllers\API\DealdetailsController::class, 'getuserdetails'])->name('getuserdetails');
    Route::get('/getteamsname', [App\Http\Controllers\API\DealdetailsController::class, 'getteamsname'])->name('getteamsname');

    //////////// Quartely Incentive ///////////
    Route::post('/upCreQuarInce', [App\Http\Controllers\API\QuarterlyIncentiveController::class, 'upCreQuarInce'])->name('upCreQuarInce');
    Route::post('/SourceQuaData', [App\Http\Controllers\API\QuarterlyIncentiveController::class, 'SourceQuaData'])->name('SourceQuaData');
    Route::post('/quarterlyData', [App\Http\Controllers\API\QuarterlyIncentiveController::class, 'quarterlyData'])->name('quarterlyData');
    Route::post('/updateQuarterly', [App\Http\Controllers\API\QuarterlyIncentiveController::class, 'updateQuarterly'])->name('updateQuarterly');
    Route::get('/quarterlydetails{id}', [App\Http\Controllers\API\QuarterlyIncentiveController::class, 'quarterlydetails'])->name('quarterlydetails');
    /////////////////////////// Half Year Incentive /////////////////////////

    Route::post('/upCreHalfInce', [App\Http\Controllers\API\HalfyearincentiveController::class, 'upCreHalfInce'])->name('upCreHalfInce');
    Route::post('/SourcehalfyearData', [App\Http\Controllers\API\HalfyearincentiveController::class, 'SourcehalfyearData'])->name('SourcehalfyearData');
    Route::post('/HalfYearDetails', [App\Http\Controllers\API\HalfyearincentiveController::class, 'HalfYearDetails'])->name('HalfYearDetails');
    Route::post('/updatehalfYear', [App\Http\Controllers\API\HalfyearincentiveController::class, 'updatehalfYear'])->name('updatehalfYear');
    Route::get('/gethalfyearUser{id}', [App\Http\Controllers\API\HalfyearincentiveController::class, 'gethalfyearUser'])->name('gethalfyearUser');

    ////////////////////////////////// Year Incentive ////////////////////////
    Route::post('/upCreYearInce', [App\Http\Controllers\API\YearIncentiveController::class, 'upCreYearInce'])->name('upCreYearInce');
    Route::post('/updateCreYear', [App\Http\Controllers\API\YearIncentiveController::class, 'updateCreYear'])->name('updateCreYear');
    Route::post('/SourceYearD', [App\Http\Controllers\API\YearIncentiveController::class, 'SourceYearD'])->name('SourceYearD');
    Route::post('/YearDetailsInce', [App\Http\Controllers\API\YearIncentiveController::class, 'YearDetailsInce'])->name('SourceYearD');
    Route::get('/getyearIncenUser_id{id}', [App\Http\Controllers\API\YearIncentiveController::class, 'getyearIncenUser_id'])->name('getyearIncenUser_id');

    Route::post('/attendance_monthwise', [App\Http\Controllers\API\AttendanceController::class, 'attendance_monthwise'])->name('attendance_monthwise');
    Route::get('/get_month', [App\Http\Controllers\API\AttendanceController::class, 'get_month'])->name('get_month');
    Route::post('/get_teamWise', [App\Http\Controllers\API\AttendanceController::class, 'get_teamWise'])->name('get_teamWise');
    // Route::post('/post_monthlysalary1', [App\Http\Controllers\API\MonthlySalary1Controller::class, 'get_monthlysalary1'])->name('get_monthlysalary1');
    Route::post('/getteamdetails', [App\Http\Controllers\API\DealdetailsController::class, 'getteamdetails'])->name('getteamdetails');
    Route::post('/getuserdata', [App\Http\Controllers\API\DealdetailsController::class, 'getuserdata'])->name('getuserdata');
    Route::post('/getattendance', [App\Http\Controllers\API\DealdetailsController::class, 'getattendance'])->name('getattendance');
    Route::get('/username', [App\Http\Controllers\API\DealdetailsController::class, 'username'])->name('username');
    Route::get('/userdetails/{id}', [App\Http\Controllers\API\DealdetailsController::class, 'userdetails'])->name('userdetails');
    Route::get('/empdata/{id}', [App\Http\Controllers\API\DealdetailsController::class, 'empdata'])->name('empdata');
    Route::get('/single_user/{id}', [App\Http\Controllers\API\DealdetailsController::class, 'single_user'])->name('single_user');
    Route::get('/username1/{id}', [App\Http\Controllers\API\DealdetailsController::class, 'username1'])->name('username1');
    Route::get('/datedata/{id}', [App\Http\Controllers\API\DealdetailsController::class, 'datedata'])->name('datedata');
    Route::post('/datefilter', [App\Http\Controllers\API\DealdetailsController::class, 'datefilter'])->name('datefilter');
    Route::post('/dateData', [App\Http\Controllers\API\DealdetailsController::class, 'dateData'])->name('dateData');
    Route::post('/getteamdetails1', [App\Http\Controllers\API\WalkindealsController::class, 'getteamdetails1'])->name('getteamdetails1');
    Route::get('/getuserdetails', [App\Http\Controllers\API\WalkindealsController::class, 'getuserdetails'])->name('getuserdetails');
    Route::get('/getwalkinlist/{id}', [App\Http\Controllers\API\WalkindealsController::class, 'getwalkinlist'])->name('getwalkinlist');
    Route::get('/getdata/{id}', [App\Http\Controllers\API\WalkindealsController::class, 'getdata'])->name('getdata');
    Route::post('/filterdata', [App\Http\Controllers\API\WalkindealsController::class, 'filterdata'])->name('filterdata');
    Route::get('/getclemp/{id}', [App\Http\Controllers\API\WalkindealsController::class, 'getclemp'])->name('getclemp');
    Route::get('/getuserid', [App\Http\Controllers\API\WalkindealsController::class, 'getuserid'])->name('getuserid');
    Route::get('/getdeals', [App\Http\Controllers\API\WalkindealsController::class, 'getdeals'])->name('getdeals');
    Route::get('/leadsgivenview', [App\Http\Controllers\API\LeadsgivenController::class, 'leadsgivenview'])->name('leadsgivenview');
    Route::get('/weeklyleadsview', [App\Http\Controllers\API\WeeklyleadsController::class, 'weeklyleadsview'])->name('weeklyleadsview');
    Route::post('/updatedateteam', [App\Http\Controllers\API\UsersController::class, 'updatedateteam'])->name('updatedateteam');

    Route::get('/getbookingid', [App\Http\Controllers\API\SalesdetailsController::class, 'getbookingid'])->name('getbookingid');
    // Route::get('/pendinginvoice', [App\Http\Controllers\API\InvoiceMultiController::class,'pendinginvoice']);
    Route::get('/pendinginvoice', [App\Http\Controllers\API\InvoiceMultiController::class, 'pendinginvoice'])->name('pendinginvoice');

    Route::post('/monthlysalarydata', [App\Http\Controllers\API\Salary\MonthlySalary1Controller::class, 'monthlysalarydata'])->name('monthlysalarydata');
    Route::post('/monthlysalarydata1', [App\Http\Controllers\API\Salary\MonthlySalary1Controller::class, 'monthlysalarydata1'])->name('monthlysalarydata1');
    Route::get('/AdvanceEmi', [App\Http\Controllers\API\Salary\AdvancesalaryController::class, 'AdvanceEmi'])->name('AdvanceEmi');
    Route::get('/Userdata/{id}', [App\Http\Controllers\API\Salary\AdvanceemiController::class, 'Userdata'])->name('Userdata');
    Route::get('/AdvanceDeduction/{id}', [App\Http\Controllers\API\Salary\AdvancesalaryController::class, 'AdvanceDeduction'])->name('AdvanceDeduction');
    Route::get('/UserAdvanceEmi/{id}', [App\Http\Controllers\API\Salary\AdvanceemiController::class, 'UserAdvanceEmi'])->name('UserAdvanceEmi');
    Route::get('/deductamount', [App\Http\Controllers\API\Salary\AdvanceemiController::class, 'deductamount'])->name('deductamount');
    Route::post('/updateAdvSal', [App\Http\Controllers\API\Salary\AdvancesalaryController::class, 'updateAdvSal'])->name('updateAdvSal');
    Route::get('/emiAmountId/{user_id}', [App\Http\Controllers\API\Salary\AdvanceemiController::class, 'emiAmountId'])->name('emiAmountId');
    Route::get('/reportdata/{user_id}', [App\Http\Controllers\API\Salary\AdvanceemiController::class, 'reportdata'])->name('reportdata');
    Route::get('/EmpData', [App\Http\Controllers\API\Salary\MonthlySalary1Controller::class, 'EmpData'])->name('EmpData');
    Route::post('/reportdata1', [App\Http\Controllers\API\Salary\MonthlySalary1Controller::class, 'reportdata1'])->name('reportdata1');
    Route::get('/dataUser1/{id}', [App\Http\Controllers\API\Salary\AdvanceemiController::class, 'dataUser1'])->name('dataUser1');

    Route::get('/leadsgivenview', [App\Http\Controllers\API\LeadsgivenController::class, 'leadsgivenview'])->name('leadsgivenview');
    Route::get('/weeklyleadsview', [App\Http\Controllers\API\WeeklyleadsController::class, 'weeklyleadsview'])->name('weeklyleadsview');
    Route::get('/getempdetails/{id}', [App\Http\Controllers\API\LeadsgivenController::class, 'getempdetails'])->name('getempdetails');
    Route::get('/singleemp/{id}', [App\Http\Controllers\API\LeadsgivenController::class, 'singleemp'])->name('singleemp');
    Route::get('/single_emp/{id}', [App\Http\Controllers\API\LeadsgivenController::class, 'single_emp'])->name('single_emp');
    Route::post('/datesorting', [App\Http\Controllers\API\LeadsgivenController::class, 'datesorting'])->name('datesorting');
    Route::get('/teamwise/{id}', [App\Http\Controllers\API\LeadsgivenController::class, 'teamwise'])->name('teamwise');
    Route::get('/leadsteams/{id}', [App\Http\Controllers\API\LeadsgivenController::class, 'leadsteams'])->name('leadsteams');
    Route::get('/allteamsdata/{id}', [App\Http\Controllers\API\LeadsgivenController::class, 'allteamsdata'])->name('allteamsdata');
    Route::get('/single_emp_data/{id}', [App\Http\Controllers\API\LeadsgivenController::class, 'single_emp_data'])->name('single_emp_data');
    Route::get('/single_employee/{id}', [App\Http\Controllers\API\WeeklyleadsController::class, 'single_employee'])->name('single_employee');
    Route::get('/weeklyteams/{id}', [App\Http\Controllers\API\WeeklyleadsController::class, 'weeklyteams'])->name('weeklyteams');
    Route::get('/single_emp_weekly/{id}', [App\Http\Controllers\API\WeeklyleadsController::class, 'single_emp_weekly'])->name('single_emp_weekly');
    Route::get('/allleadsdata/{id}', [App\Http\Controllers\API\WeeklyleadsController::class, 'allleadsdata'])->name('allleadsdata');
    Route::post('/dateformating', [App\Http\Controllers\API\WeeklyleadsController::class, 'dateformating'])->name('dateformating');
    Route::post('/weekwise', [App\Http\Controllers\API\WeeklyleadsController::class, 'weekwise'])->name('weekwise');
    Route::post('/weekdata', [App\Http\Controllers\API\WeeklyleadsController::class, 'weekdata'])->name('weekdata');

    Route::get('/teamleaderslist', [App\Http\Controllers\API\TeamleadersController::class, 'teamleaderslist'])->name('teamleaderslist');
    Route::get('/regionheadslist', [App\Http\Controllers\API\TeamleadersController::class, 'regionheadslist'])->name('regionheadslist');

    //shikha*ReportModule//
    Route::get('/getReceiptCountReport', [App\Http\Controllers\API\ReceiptDetailsController::class, 'getReceiptCountReport'])->name('getReceiptCountReport');
    Route::get('/getSalesCountReport', [App\Http\Controllers\API\SalesdetailsController::class, 'getSalesCountReport'])->name('getSalesCountReport');
    Route::get('/monthwisedata/{booking_date}', [App\Http\Controllers\API\SalesdetailsController::class, 'monthwisedata'])->name('monthwisedata');
    Route::get('/monthwisedatalist/{month}', [App\Http\Controllers\API\SalesdetailsController::class, 'monthwisedatalist'])->name('monthwisedatalist');
    Route::get('/monthwisedatalist1/{month}', [App\Http\Controllers\API\ReceiptDetailsController::class, 'monthwisedatalist1'])->name('monthwisedatalist1');
    Route::get('/monthfilterdata/{month}', [App\Http\Controllers\API\SalesdetailsController::class, 'monthfilterdata'])->name('monthfilterdata');
    Route::get('/monthfilterdata1/{month}', [App\Http\Controllers\API\ReceiptDetailsController::class, 'monthfilterdata1'])->name('monthfilterdata1');
    Route::get('/dataattendance/{year}', [App\Http\Controllers\API\AttendanceController::class, 'dataattendance'])->name('dataattendance');
    Route::get('/getdatevalue', [App\Http\Controllers\API\SalesdetailsController::class, 'getdatevalue'])->name('getdatevalue');
    Route::get('/getdatevalue1', [App\Http\Controllers\API\ReceiptDetailsController::class, 'getdatevalue1'])->name('getdatevalue1');
    Route::get('/getamountmonth', [App\Http\Controllers\API\SalesdetailsController::class, 'getamountmonth'])->name('getamountmonth');
    //shikha*ReportModule//

    //invoice chart//
    Route::get('/getmonthvalue1', [App\Http\Controllers\API\InvoiceMultiController::class, 'getmonthvalue1'])->name('getmonthvalue1');
    Route::get('/getinvoicevalue2', [App\Http\Controllers\API\InvoiceMultiController::class, 'getinvoicevalue2'])->name('getinvoicevalue2');
    Route::get('/getinvoicevalue3', [App\Http\Controllers\API\InvoiceMultiController::class, 'getinvoicevalue3'])->name('getinvoicevalue3');

    ///inv_sum//
    Route::get('/getinvoiceSum1', [App\Http\Controllers\API\InvoiceMultiController::class, 'getinvoiceSum1'])->name('getinvoiceSum1');
    Route::get('/getinvoiceSum2', [App\Http\Controllers\API\InvoiceMultiController::class, 'getinvoiceSum2'])->name('getinvoiceSum2');
    Route::get('/getinvoiceSum3', [App\Http\Controllers\API\InvoiceMultiController::class, 'getinvoiceSum3'])->name('getinvoiceSum3');
    Route::get('/getmonthvalue2', [App\Http\Controllers\API\InvoiceMultiController::class, 'getmonthvalue2'])->name('getmonthvalue2');
    Route::get('/invomonthwisedatalist/{month}', [App\Http\Controllers\API\InvoiceMultiController::class, 'invomonthwisedatalist'])->name('invomonthwisedatalist');
    // Route::get('/invomonthfilterdata/{month}', [App\Http\Controllers\API\InvoiceMultiController::class,'invomonthfilterdata'])->name('invomonthfilterdata');
    // Route::get('/invomonthfilterdata1/{month}', [App\Http\Controllers\API\InvoiceMultiController::class,'invomonthfilterdata1'])->name('invomonthfilterdata1');
    // Route::get('/invomonthfilterdata2/{month}', [App\Http\Controllers\API\InvoiceMultiController::class,'invomonthfilterdata2'])->name('invomonthfilterdata2');

    Route::get('/getinvoicevalue1', [App\Http\Controllers\API\InvoiceMultiController::class, 'getinvoicevalue1'])->name('getinvoicevalue1');

    //shikha*ReportModule//
    Route::get('/getReceiptCountReport', [App\Http\Controllers\API\ReceiptDetailsController::class, 'getReceiptCountReport'])->name('getReceiptCountReport');
    Route::get('/getSalesCountReport', [App\Http\Controllers\API\SalesdetailsController::class, 'getSalesCountReport'])->name('getSalesCountReport');
    Route::get('/monthwisedata/{booking_date}', [App\Http\Controllers\API\SalesdetailsController::class, 'monthwisedata'])->name('monthwisedata');
    Route::get('/monthwisedatalist/{month}', [App\Http\Controllers\API\SalesdetailsController::class, 'monthwisedatalist'])->name('monthwisedatalist');
    Route::get('/monthwisedatalist1/{month}', [App\Http\Controllers\API\ReceiptDetailsController::class, 'monthwisedatalist1'])->name('monthwisedatalist1');
    Route::get('/monthfilterdata/{month}', [App\Http\Controllers\API\SalesdetailsController::class, 'monthfilterdata'])->name('monthfilterdata');
    Route::get('/monthfilterdata1/{month}', [App\Http\Controllers\API\ReceiptDetailsController::class, 'monthfilterdata1'])->name('monthfilterdata1');
    Route::get('/dataattendance/{year}', [App\Http\Controllers\API\AttendanceController::class, 'dataattendance'])->name('dataattendance');
    Route::get('/getdatevalue', [App\Http\Controllers\API\SalesdetailsController::class, 'getdatevalue'])->name('getdatevalue');
    Route::get('/getdatevalue1', [App\Http\Controllers\API\ReceiptDetailsController::class, 'getdatevalue1'])->name('getdatevalue1');
    Route::get('/getamountmonth', [App\Http\Controllers\API\SalesdetailsController::class, 'getamountmonth'])->name('getamountmonth');
    //shikha*ReportModule//

    //invoice chart//
    Route::get('/getmonthvalue1', [App\Http\Controllers\API\InvoiceMultiController::class, 'getmonthvalue1'])->name('getmonthvalue1');
    Route::get('/getinvoicevalue2', [App\Http\Controllers\API\InvoiceMultiController::class, 'getinvoicevalue2'])->name('getinvoicevalue2');
    Route::get('/getinvoicevalue3', [App\Http\Controllers\API\InvoiceMultiController::class, 'getinvoicevalue3'])->name('getinvoicevalue3');

    ///inv_sum//
    Route::get('/getinvoiceSum1', [App\Http\Controllers\API\InvoiceMultiController::class, 'getinvoiceSum1'])->name('getinvoiceSum1');
    Route::get('/getinvoiceSum2', [App\Http\Controllers\API\InvoiceMultiController::class, 'getinvoiceSum2'])->name('getinvoiceSum2');
    Route::get('/getinvoiceSum3', [App\Http\Controllers\API\InvoiceMultiController::class, 'getinvoiceSum3'])->name('getinvoiceSum3');
    Route::get('/getmonthvalue2', [App\Http\Controllers\API\InvoiceMultiController::class, 'getmonthvalue2'])->name('getmonthvalue2');
    Route::get('/invomonthwisedatalist/{month}', [App\Http\Controllers\API\InvoiceMultiController::class, 'invomonthwisedatalist'])->name('invomonthwisedatalist');
    Route::get('/getinvoicevalue1', [App\Http\Controllers\API\InvoiceMultiController::class, 'getinvoicevalue1'])->name('getinvoicevalue1');
    ///invoice chart//
    Route::get('/getEmpcode', [App\Http\Controllers\API\UsersController::class, 'getEmpcode'])->name('getEmpcode');
    Route::post('/EmpData7', [App\Http\Controllers\API\Salary\MonthlySalary1Controller::class, 'EmpData7'])->name('EmpData7');
    Route::post('/monthlysalarydata2', [App\Http\Controllers\API\Salary\MonthlySalary1Controller::class, 'monthlysalarydata2'])->name('monthlysalarydata2');

    Route::post('/monthleaderlist', [App\Http\Controllers\API\monthleadController::class, 'monthleaderlist'])->name('monthleaderlist');
    Route::post('/monthleaderlist1', [App\Http\Controllers\API\monthleadController::class, 'monthleaderlist1'])->name('monthleaderlist1');
    Route::post('/monthleaderlist2', [App\Http\Controllers\API\monthleadController::class, 'monthleaderlist2'])->name('monthleaderlist2');
    Route::get('/leadmonthreport', [App\Http\Controllers\API\monthleadController::class, 'leadmonthreport'])->name('leadmonthreport');
    Route::get('/leadmonthwise', [App\Http\Controllers\API\monthleadController::class, 'leadmonthwise'])->name('leadmonthwise');
    Route::get('/leadyearreport', [App\Http\Controllers\API\yearleadController::class, 'leadyearreport'])->name('leadyearreport');
    // Route::get('/monthTeamleadlist/{month}', [App\Http\Controllers\API\LeadController::class,'monthTeamleadlist'])->name('monthTeamleadlist');
    Route::post('/dateleaderlist2', [App\Http\Controllers\API\LeadController::class, 'dateleaderlist2'])->name('dateleaderlist2');
    Route::post('/dateleaderlist1', [App\Http\Controllers\API\LeadController::class, 'dateleaderlist1'])->name('dateleaderlist1');
    Route::post('/dateleaderlist', [App\Http\Controllers\API\LeadController::class, 'dateleaderlist'])->name('dateleaderlist');
    Route::post('/weekleaderlist', [App\Http\Controllers\API\DateLeadController::class, 'weekleaderlist'])->name('weekleaderlist');
    Route::post('/weekleaderlist1', [App\Http\Controllers\API\DateLeadController::class, 'weekleaderlist1'])->name('weekleaderlist1');
    Route::post('/weekleaderlist2', [App\Http\Controllers\API\DateLeadController::class, 'weekleaderlist2'])->name('weekleaderlist2');
    // Route::get('/leadDatereport', [App\Http\Controllers\API\DateLeadController::class,'leadDatereport'])->name('leadDatereport');
    // Route::get('/leadDatewise', [App\Http\Controllers\API\DateLeadController::class,'leadDatewise'])->name('leadDatewise');
    Route::get('/leadteamwise', [App\Http\Controllers\API\LeadController::class, 'leadteamwise'])->name('leadteamwise');
    Route::get('/leadreport', [App\Http\Controllers\API\LeadController::class, 'leadreport'])->name('leadreport');

    ///////year///////
    Route::post('/yearleaderlist', [App\Http\Controllers\API\monthleadController::class, 'yearleaderlist'])->name('yearleaderlist');
    Route::post('/yearleaderlist1', [App\Http\Controllers\API\monthleadController::class, 'yearleaderlist1'])->name('yearleaderlist1');
    Route::post('/yearleaderlist2', [App\Http\Controllers\API\monthleadController::class, 'yearleaderlist2'])->name('yearleaderlist2');

    ///////////////////////////
    Route::get('/attendance_userdata', [App\Http\Controllers\API\AttendanceController::class, 'attendance_userdata'])->name('attendance_userdata');
    Route::get('/useremp', [App\Http\Controllers\API\AttendanceController::class, 'useremp'])->name('useremp');
    Route::get('/employeeemp', [App\Http\Controllers\API\AttendanceController::class, 'employeeemp'])->name('employeeemp');
    Route::get('/tdata', [App\Http\Controllers\API\AttendanceController::class, 'tdata'])->name('tdata');
    Route::post('/insertalldata', [App\Http\Controllers\API\AttendanceController::class, 'insertalldata'])->name('insertalldata');
    Route::get('/getusermapped/{id}', [App\Http\Controllers\API\WalkindealsController::class, 'getusermapped'])->name('getusermapped');

    Route::post('/alldata', [App\Http\Controllers\API\WalkindealsController::class, 'alldata'])->name('alldata');
    Route::get('/walkindata', [App\Http\Controllers\API\WalkindealsController::class, 'walkindata'])->name('walkindata');

    Route::post('/getreceiptset', [App\Http\Controllers\API\ReceiptDetailsController::class, 'getreceiptset'])->name('getreceiptset');
    Route::post('/updatereceiptset', [App\Http\Controllers\API\ReceiptDetailsController::class, 'updatereceiptset'])->name('updatereceiptset');
    Route::get('/Receipt1', [App\Http\Controllers\API\ReceiptDetailsController::class, 'Receipt1'])->name('Receipt1');
    Route::get('/invoice_multi1/{id}', [App\Http\Controllers\API\InvoiceMultiController::class, 'invoice_multi1'])->name('invoice_multi1');

    ///////////Tl with payvoucher///////////
    Route::post('/utlpayout', [App\Http\Controllers\API\PayvouchertlController::class, 'uTLPayout'])->name('uTLPayout');

    Route::post('/gettlddporn', [App\Http\Controllers\API\PayvouchertlDetailsController::class, 'getTLDDPOrN'])->name('getTLDDPOrN');
    Route::post('/utldpvoucher', [App\Http\Controllers\API\PayvouchertlDetailsController::class, 'uTLDPVoucher'])->name('uTLDPVoucher');

    Route::post('/updatetlpdm', [App\Http\Controllers\API\PayvouchertlDetailsController::class, 'updateTLPDM'])->name('updateTLPDM');
    Route::post('/updatetlpdq', [App\Http\Controllers\API\PayvouchertlDetailsController::class, 'updateTLPDQ'])->name('updateTLPDQ');
    Route::post('/updatetlpdhy', [App\Http\Controllers\API\PayvouchertlDetailsController::class, 'updateTLPDHY'])->name('updateTLPDHY');
    Route::post('/updatetlpdy', [App\Http\Controllers\API\PayvouchertlDetailsController::class, 'updateTLPDY'])->name('updateTLPDY');

    //04-05-2023
    Route::post('/gettldporn', [App\Http\Controllers\API\PayvouchertlController::class, 'getTLDPOrN'])->name('getTLDPOrN');

    Route::post('/getpvmtl', [App\Http\Controllers\API\PayvouchertlController::class, 'getPVMTLdata'])->name('getPVMTLdata');
    Route::post('/getpvqtl', [App\Http\Controllers\API\PayvouchertlController::class, 'getPVQTLdata'])->name('getPVQTLdata');
    Route::post('/getpvhytl', [App\Http\Controllers\API\PayvouchertlController::class, 'getPVHYTLdata'])->name('getPVHYTLdata');
    Route::post('/getpvytl', [App\Http\Controllers\API\PayvouchertlController::class, 'getPVYTLdata'])->name('getPVYTLdata');

    //03-05-2023
    Route::post('/getduetlmr', [App\Http\Controllers\API\TlmonthlyincentiveController::class, 'getDueTLMR'])->name('getDueTLMR');
    Route::post('/getduetlqr', [App\Http\Controllers\API\TlmonthlyincentiveController::class, 'getDueTLQR'])->name('getDueTLQR');
    Route::post('/getduetlhyr', [App\Http\Controllers\API\TlmonthlyincentiveController::class, 'getDueTLHYR'])->name('getDueTLHYR');
    Route::post('/getduetlyr', [App\Http\Controllers\API\TlmonthlyincentiveController::class, 'getDueTLYR'])->name('getDueTLYR');

    //28-04-2023
    Route::post('/userpornpvd', [App\Http\Controllers\API\PayvoucherDetailsController::class, 'userPorNPVD'])->name('userPorNPVD');
    Route::post('/updatepvdu', [App\Http\Controllers\API\PayvoucherDetailsController::class, 'updatePVDU'])->name('updatePVDU');

    //27-04-2023
    Route::post('/getpvm', [App\Http\Controllers\API\PayvoucherController::class, 'getPVMdata'])->name('getPVMdata');
    Route::post('/getpvq', [App\Http\Controllers\API\PayvoucherController::class, 'getPVQdata'])->name('getPVQdata');
    Route::post('/getpvhy', [App\Http\Controllers\API\PayvoucherController::class, 'getPVHYdata'])->name('getPVHYdata');
    Route::post('/getpvy', [App\Http\Controllers\API\PayvoucherController::class, 'getPVYdata'])->name('getPVYdata');

    //24-04-2023
    Route::post('/updateppm', [App\Http\Controllers\API\PayvoucherController::class, 'updaFtePPM'])->name('updatePPM');
    Route::post('/updateppq', [App\Http\Controllers\API\PayvoucherController::class, 'updatePPQ'])->name('updatePPQ');
    Route::post('/updatepphy', [App\Http\Controllers\API\PayvoucherController::class, 'updatePPHY'])->name('updatePPHY');
    Route::post('/updateppy', [App\Http\Controllers\API\PayvoucherController::class, 'updatePPY'])->name('updatePPY');

    //22-04-2023
    Route::post('/getdporn', [App\Http\Controllers\API\PayvoucherController::class, 'getDPOrN'])->name('getDPOrN');
    Route::post('/upayout', [App\Http\Controllers\API\PayvoucherController::class, 'uPayout'])->name('uPayout');

    //19-04-2023
    Route::post('/getmdueuser', [App\Http\Controllers\API\MonthlyIncentiveController::class, 'getMDueUser'])->name('getMDueUser');
    Route::post('/getqdueuser', [App\Http\Controllers\API\MonthlyIncentiveController::class, 'getQDueUser'])->name('getQDueUser');
    Route::post('/gethydueuser', [App\Http\Controllers\API\MonthlyIncentiveController::class, 'getHYDueUser'])->name('getHYDueUser');
    Route::post('/getydueuser', [App\Http\Controllers\API\MonthlyIncentiveController::class, 'getYDueUser'])->name('getYDueUser');
    Route::post('/getteamtliduser', [App\Http\Controllers\API\MonthlyIncentiveController::class, 'getTeamTlIdUser'])->name('getTeamTlIdUser');

    //18-04-2023
    Route::post('/uptlyeligible', [App\Http\Controllers\API\TlyearlyincentiveController::class, 'upTLYEligible'])->name('upTLYEligible');
    Route::post('/uptlhyeligible', [App\Http\Controllers\API\TlhalfyearincentiveController::class, 'upTLHYEligible'])->name('upTLHYEligible');
    Route::post('/uptlqeligible', [App\Http\Controllers\API\TlquarterlyincentiveController::class, 'upTLQEligible'])->name('upTLQEligible');

    //17-04-2023
    Route::post('/gettlusersintbl', [App\Http\Controllers\API\TlquarterlyincentiveController::class, 'getTLUsersInTBL'])->name('getTLUsersInTBL');
    Route::post('/getalltlusers', [App\Http\Controllers\API\TlquarterlyincentiveController::class, 'getAllTLUsers'])->name('getAllTLUsers');

    //15-04-2023
    Route::post('/uyiusinghyu', [App\Http\Controllers\API\YearIncentiveController::class, 'uyiUsingHYU'])->name('uyiUsingHYU');
    Route::post('/gethyuy', [App\Http\Controllers\API\YearIncentiveController::class, 'getHYUY'])->name('getHYUY');

    Route::post('/uhyiusingqu', [App\Http\Controllers\API\HalfyearincentiveController::class, 'uhyiUsingQU'])->name('uhyiUsingQU');
    Route::post('/getquhr', [App\Http\Controllers\API\HalfyearincentiveController::class, 'getQUHR'])->name('getQUHR');

    Route::post('/uqiusingmu', [App\Http\Controllers\API\QuarterlyIncentiveController::class, 'uqiUsingMU'])->name('uqiUsingMU');
    Route::post('/gettblmiqu', [App\Http\Controllers\API\QuarterlyIncentiveController::class, 'getTblMIQU'])->name('getTblMIQU');
    Route::post('/utblmonthlyme', [App\Http\Controllers\API\ReceiptDetailsController::class, 'utblmonthlyME'])->name('utblmonthlyME');

    //14-04-2023
    Route::post('/utblmonthlypb', [App\Http\Controllers\API\ReceiptDetailsController::class, 'utblmonthlyPB'])->name('utblmonthlyPB');
    Route::get('/getpayoutdeals', [App\Http\Controllers\API\ReceiptDetailsController::class, 'getPayoutDeals'])->name('getPayoutDeals');
    Route::post('/getsalesids', [App\Http\Controllers\API\ReceiptDetailsController::class, 'getSalesIds'])->name('getSalesIds');
    Route::post('/getreceiptdetails', [App\Http\Controllers\API\ReceiptDetailsController::class, 'getReceiptDetails'])->name('getReceiptDetails');

    //TL Monthly Incentive
    Route::post('/getuserutlida', [App\Http\Controllers\API\TlmonthlyincentiveController::class, 'getUserUTLIdA'])->name('getUserUTLIdA');
    Route::post('/getmtl', [App\Http\Controllers\API\TlmonthlyincentiveController::class, 'getMTL'])->name('getMTL');

    //PR 08-04-2023
    Route::post('/umonthlyincentiveprs', [App\Http\Controllers\API\MonthlyIncentiveController::class, 'uMonthlyIncentivePRS'])->name('uMonthlyIncentivePRS');
    Route::post('/umonthlyincentiveprc', [App\Http\Controllers\API\MonthlyIncentiveController::class, 'uMonthlyIncentivePRC'])->name('uMonthlyIncentivePRC');

    //Invoice
    Route::post('/getinvoicedetails', [App\Http\Controllers\API\MonthlyIncentiveController::class, 'getInvoiceDetails'])->name('getInvoiceDetails');

    Route::post('/umonthlyincentivesi', [App\Http\Controllers\API\MonthlyIncentiveController::class, 'uMonthlyIncentiveSI'])->name('uMonthlyIncentiveSI');
    Route::post('/umonthlyincentiveci', [App\Http\Controllers\API\MonthlyIncentiveController::class, 'uMonthlyIncentiveCI'])->name('uMonthlyIncentiveCI');

    Route::get('/getsourcingincentivea/{tir}', [App\Http\Controllers\API\MonthlyIncentiveController::class, 'getSourcingIncentiveA'])->name('getSourcingIncentiveA');
    Route::get('/getclosingincentivea/{tir}', [App\Http\Controllers\API\MonthlyIncentiveController::class, 'getClosingIncentiveA'])->name('getClosingIncentiveA');

    //yearly
    Route::post('/getuseryeardeal', [App\Http\Controllers\API\YearIncentiveController::class, 'getUserYearDeal'])->name('getUserYearDeal');
    Route::post('/getIncentivebhi', [App\Http\Controllers\API\YearIncentiveController::class, 'getIncentiveB27'])->name('getIncentiveB27');
    Route::post('/getIncentiveahi', [App\Http\Controllers\API\YearIncentiveController::class, 'getIncentiveA27'])->name('getIncentiveA27');

    //halfyear
    Route::post('/gethalfyearuserr', [App\Http\Controllers\API\HalfyearincentiveController::class, 'getHalfYearUserr'])->name('getHalfYearUserr');
    Route::post('/getincentiveb', [App\Http\Controllers\API\HalfyearincentiveController::class, 'getIncentiveB18'])->name('getIncentiveB18');
    Route::post('/getincentivea', [App\Http\Controllers\API\HalfyearincentiveController::class, 'getIncentiveA18'])->name('getIncentiveA18');

    //quaterly
    Route::post('/getpresentdeal', [App\Http\Controllers\API\QuarterlyIncentiveController::class, 'getPresentDeal'])->name('getPresentDeal');
    Route::post('/getincentivebbeight', [App\Http\Controllers\API\QuarterlyIncentiveController::class, 'getIncentiveBBEight'])->name('getIncentiveBBEight');
    Route::post('/getincentiveaaeight', [App\Http\Controllers\API\QuarterlyIncentiveController::class, 'getIncentiveAAEight'])->name('getIncentiveAAEight');
    Route::post('/getuserbymy', [App\Http\Controllers\API\QuarterlyIncentiveController::class, 'getUserBYMY'])->name('getUserBYMY');

    //user closing
    Route::post('/closingdatacount', [App\Http\Controllers\API\MonthlyIncentiveController::class, 'ClosingDataCount'])->name('ClosingDataCount');
    Route::get('/gettblincentivesrangeecc/{tir}', [App\Http\Controllers\API\MonthlyIncentiveController::class, 'getTblIncentivesRangeeCC'])->name('getTblIncentivesRangeeCC');
    Route::post('/umonthlyincentivecc', [App\Http\Controllers\API\MonthlyIncentiveController::class, 'uMonthlyIncentiveCC'])->name('uMonthlyIncentiveCC');

    //user monthly incentive s
    Route::post('/sourcingdatacount', [App\Http\Controllers\API\MonthlyIncentiveController::class, 'SourcingDataCount'])->name('SourcingDataCount');
    Route::get('/getincentiverangee/{tblir}', [App\Http\Controllers\API\MonthlyIncentiveController::class, 'getIncentiveRangee'])->name('getIncentiveRangee');
    Route::get('/gettblincentivesrangee/{tir}', [App\Http\Controllers\API\MonthlyIncentiveController::class, 'getTblIncentivesRangee'])->name('getTblIncentivesRangee');
    Route::post('/umonthlyincentives', [App\Http\Controllers\API\MonthlyIncentiveController::class, 'uMonthlyIncentiveS'])->name('uMonthlyIncentiveS');
    Route::post('/getmonthlyuser', [App\Http\Controllers\API\MonthlyIncentiveController::class, 'getMonthlyUser'])->name('getMonthlyUser');

    //24-03-2023 tl yearly incentive
    Route::get('/gettlylastuser', [App\Http\Controllers\API\TlyearlyincentiveController::class, 'getTLYLastUser'])->name('getTLYLastUser');
    Route::post('/gettlydata', [App\Http\Controllers\API\TlyearlyincentiveController::class, 'getTLYData'])->name('getTLYData');
    Route::post('/gettlmytldata', [App\Http\Controllers\API\TlyearlyincentiveController::class, 'getTLMYTlData'])->name('getTLMYTlData');
    Route::post('/updateytlincentive', [App\Http\Controllers\API\TlyearlyincentiveController::class, 'updateYTLIncentive'])->name('updateYTLIncentive');
    Route::get('/getyitlincentive/{ts}', [App\Http\Controllers\API\TlincentivestructureController::class, 'getYITLIncentive'])->name('getYITLIncentive');

    //23-03-2023 tl half year incentive
    Route::get('/gettlhylastuser', [App\Http\Controllers\API\TlhalfyearincentiveController::class, 'getTLHYLastUser'])->name('getTLHYLastUser');
    Route::post('/gettlhydata', [App\Http\Controllers\API\TlhalfyearincentiveController::class, 'getTLHYData'])->name('getTLHYData');
    Route::post('/gettlmhytlData', [App\Http\Controllers\API\TlhalfyearincentiveController::class, 'getTLMHYTlData'])->name('getTLMHYTlData');
    Route::post('/updatehytlincentive', [App\Http\Controllers\API\TlhalfyearincentiveController::class, 'updateHYTLIncentive'])->name('updateHYTLIncentive');
    Route::get('/gethyitlincentive/{ts}', [App\Http\Controllers\API\TlincentivestructureController::class, 'getHYITLIncentive'])->name('getHYITLIncentive');

    //23-03-2023
    Route::post('/updateqtlincentive', [App\Http\Controllers\API\TlquarterlyincentiveController::class, 'updateQTLIncentive'])->name('updateQTLIncentive');
    //22-03-2023
    Route::post('/gettlqdata', [App\Http\Controllers\API\TlquarterlyincentiveController::class, 'getTLQData'])->name('getTLQData');
    Route::get('/gettlqlastuser', [App\Http\Controllers\API\TlquarterlyincentiveController::class, 'getTLQLastUser'])->name('getTLQLastUser');
    Route::get('/gettltiduid/{semp_id}', [App\Http\Controllers\API\TlquarterlyincentiveController::class, 'getTlTidUid'])->name('getTlTidUid');
    Route::post('/gettlmqtldata', [App\Http\Controllers\API\TlquarterlyincentiveController::class, 'getTLMQTlData'])->name('getTLMQTlData');
    Route::get('/getqtlincentive/{ts}', [App\Http\Controllers\API\TlincentivestructureController::class, 'getQTLIncentive'])->name('getQTLIncentive');

    Route::post('/getalluserdata', [App\Http\Controllers\API\TlmonthlyincentiveController::class, 'getAllUserData'])->name('getAllUserData');

    //14-03-2023 get tl name using team id
    Route::post('/gettidtl', [App\Http\Controllers\API\TlmonthlyincentiveController::class, 'getTidTl'])->name('getTidTl');
    Route::post('/gettldata', [App\Http\Controllers\API\TlmonthlyincentiveController::class, 'getTLData'])->name('getTLData');
    Route::post('/addtlmonthlyincentive', [App\Http\Controllers\API\TlmonthlyincentiveController::class, 'addTlMonthlyIncentive'])->name('addTlMonthlyIncentive');

    //13-03-2023
    Route::post('/updatetlmi', [App\Http\Controllers\API\TlmonthlyincentiveController::class, 'updatetlmi'])->name('updatetlmi');
    Route::get('/gettopthreesales/{u_id}', [App\Http\Controllers\API\MonthlyIncentiveController::class, 'getTopThreeSales'])->name('getTopThreeSales');

    //12-3-2023
    Route::get('/getactivetl', [App\Http\Controllers\API\TlmonthlyincentiveController::class, 'getActiveTL'])->name('getActiveTL');
    Route::get('/gettlmlastuser', [App\Http\Controllers\API\TlmonthlyincentiveController::class, 'getTLMLastUser'])->name('getTLMLastUser');
    Route::get('/gettluserid/{u_id}', [App\Http\Controllers\API\TlmonthlyincentiveController::class, 'getTLUserId'])->name('getTLUserId');

    //16-03-2023
    // Route::get('/getusersutlid/{t_id}' , [App\Http\Controllers\API\TlmonthlyincentiveController::class, 'getUsersUTLId'])->name('getUsersUTLId');
    Route::post('/getusersutlid', [App\Http\Controllers\API\TlmonthlyincentiveController::class, 'getUsersUTLId'])->name('getUsersUTLId');

    Route::post('/tlmonthlyincentivecontroller', [App\Http\Controllers\API\TlmonthlyincentiveController::class, 'getIncOfAllUsers'])->name('getIncOfAllUsers');

    //08-03-2023
    Route::get('/getlastryidata', [App\Http\Controllers\API\YearIncentiveController::class, 'getLastRYIData'])->name('getLastRYIData');
    Route::post('/getyeardeals', [App\Http\Controllers\API\YearIncentiveController::class, 'getYearDeals'])->name('getYearDeals');
    Route::post('/updateyearincetive', [App\Http\Controllers\API\YearIncentiveController::class, 'updateYearIncetive'])->name('updateYearIncetive');

    //06-03-2023
    Route::get('/getcurrentlastuser', [App\Http\Controllers\API\HalfyearincentiveController::class, 'getCurrentLastUser'])->name('getCurrentLastUser');
    Route::post('/gethalfyeardeals', [App\Http\Controllers\API\HalfyearincentiveController::class, 'getHalfYearDeals'])->name('getHalfYearDeals');
    Route::post('/updatehalfyearincetive', [App\Http\Controllers\API\HalfyearincentiveController::class, 'updateHalfYearIncetive'])->name('updateHalfYearIncetive');

    //04-03-2023
    Route::post('/updatequarterlyincetive', [App\Http\Controllers\API\QuarterlyIncentiveController::class, 'updateQuarterlyIncetive'])->name('updateQuarterlyIncetive');

    //03-03-2023
    Route::post('/getquarterlydeals', [App\Http\Controllers\API\QuarterlyIncentiveController::class, 'getQuarterlyDeals'])->name('getQuarterlyDeals');
    Route::post('/getrange', [App\Http\Controllers\API\QuarterlyIncentiveController::class, 'getRange'])->name('getRange');
    Route::post('/getquarterlyincentive', [App\Http\Controllers\API\QuarterlyIncentiveController::class, 'getQuarterlyIncentive'])->name('getQuarterlyIncentive');
    Route::get('/getqidata', [App\Http\Controllers\API\QuarterlyIncentiveController::class, 'getQIData'])->name('getQIData');

    //02-03-2023
    Route::post('/getsouringemp', [App\Http\Controllers\API\MonthlyIncentiveController::class, 'getSouringEmp'])->name('getSouringEmp');
    Route::post('/getsouringemppa', [App\Http\Controllers\API\MonthlyIncentiveController::class, 'getSouringEmpPa'])->name('getSouringEmpPa');

    //01-03-2023
    Route::get('/getinvoicesales/{id}', [App\Http\Controllers\API\InvoicedetidsController::class, 'getInvoiceSales'])->name('getInvoiceSales');

    //28-2-2023
    Route::post('/updateAiNoSourcing', [App\Http\Controllers\API\MonthlyIncentiveController::class, 'updateAiNoSourcing'])->name('updateAiNoSourcing');
    Route::post('/updateAiNoClosing', [App\Http\Controllers\API\MonthlyIncentiveController::class, 'updateAiNoClosing'])->name('updateAiNoClosing');

    //27-2-2023
    Route::post('/getSouringDealWihDealStatus', [App\Http\Controllers\API\MonthlyIncentiveController::class, 'getSouringDealWihDealStatus'])->name('getSouringDealWihDealStatus');
    Route::post('/updatebe', [App\Http\Controllers\API\MonthlyIncentiveController::class, 'updateBE'])->name('updateBE');
    Route::post('/updateGiNoSourcing', [App\Http\Controllers\API\MonthlyIncentiveController::class, 'updateGiNoSourcing'])->name('updateGiNoSourcing');
    Route::post('/updateGiNoClosing', [App\Http\Controllers\API\MonthlyIncentiveController::class, 'updateGiNoClosing'])->name('updateGiNoClosing');

    //25-2-2023
    Route::get('/getclientidtwo/{id}', [App\Http\Controllers\API\InvoiceController::class, 'getclientidtwo'])->name('getclientidtwo');
    Route::get('/getsalesidproject/{id}', [App\Http\Controllers\API\InvoiceController::class, 'getsalesidproject'])->name('getsalesidproject');

    //23-2-2023
    Route::post('/getsouringdealmi', [App\Http\Controllers\API\MonthlyIncentiveController::class, 'getSouringDealMI'])->name('getSouringDealMI');
    Route::post('/getclosingdealmi', [App\Http\Controllers\API\MonthlyIncentiveController::class, 'getClosingDealMI'])->name('getClosingDealMI');
    Route::get('/getSouringDealmitest', [App\Http\Controllers\API\MonthlyIncentiveController::class, 'getSouringDealMITest'])->name('getSouringDealMITest');
    Route::post('/updatemibonus', [App\Http\Controllers\API\MonthlyIncentiveController::class, 'updateMiBonus'])->name('updateMiBonus');

    //21-2-2023
    Route::get('/getlastrecordmi', [App\Http\Controllers\API\MonthlyIncentiveController::class, 'getLastRecordMI'])->name('getLastRecordMI');

    //20-2-2023
    Route::get('/getactiveuser', [App\Http\Controllers\API\UsersController::class, 'getActiveuser'])->name('getActiveuser');

    //crm lead data//
    Route::get('/monthleadlist/{month}', [App\Http\Controllers\API\LeadController::class, 'monthleadlist'])->name('monthleadlist');
    Route::get('/userleadlist/{user_name}', [App\Http\Controllers\API\LeadController::class, 'userleadlist'])->name('userleadlist');
    Route::get('/teamleaderlist/{teamleader_name}', [App\Http\Controllers\API\LeadController::class, 'teamleaderlist'])->name('teamleaderlist');
    Route::get('/dateleaderlist/{date}', [App\Http\Controllers\API\LeadController::class, 'dateleaderlist'])->name('dateleaderlist');
    //   Route::get('/handle', [App\Console\Commands\DemoCron::class,'handle'])->name('handle');
    Route::get('/leadprojectwise', [App\Http\Controllers\API\ProjectController::class, 'leadprojectwise'])->name('leadprojectwise');
    Route::get('/leadDatereport', [App\Http\Controllers\API\DateLeadController::class, 'leadDatereport'])->name('leadDatereport');
    Route::get('/leadDatewise', [App\Http\Controllers\API\DateLeadController::class, 'leadDatewise'])->name('leadDatewise');
    Route::get('/leadteamwise', [App\Http\Controllers\API\LeadController::class, 'leadteamwise'])->name('leadteamwise');
    Route::get('/projectreport', [App\Http\Controllers\API\ProjectController::class, 'projectreport'])->name('projectreport');
    Route::get('/leadreport', [App\Http\Controllers\API\LeadController::class, 'leadreport'])->name('leadreport');
    //consultancy-fees//

    Route::get('/getUserDesgination/{designation_id}', [App\Http\Controllers\API\ConsultancyFessController::class, 'getUserDesgination'])->name('getUserDesgination');
    Route::get('/getCFCValue', [App\Http\Controllers\API\ConsultancyFessController::class, 'getCFCValue'])->name('getCFCValue');
    Route::get('/getSelectedDesignation/{d_id}', [App\Http\Controllers\API\ConsultancyFessController::class, 'getSelectedDesignation'])->name('getSelectedDesignation');
    //29-12-2022
    Route::get('/userTLRH/{u_id}', [App\Http\Controllers\API\ConsultancyFessController::class, 'userTLRH'])->name('userTLRH');
    //1-20-2023
    Route::get('/userTLRH2/{u_id}/{startdate}/{enddate}', [App\Http\Controllers\API\ConsultancyFessController::class, 'userTLRH2'])->name('userTLRH2');
    Route::get('/getUsersCF', [App\Http\Controllers\API\ConsultancyFessController::class, 'getUsersCF'])->name('getUsersCF');
    Route::get('/getUsersDesignationNo/{uu_id}', [App\Http\Controllers\API\ConsultancyFessController::class, 'getUsersDesignationNo'])->name('getUsersDesignationNo');

    //03-01-2022
    Route::get('/updateTable', [App\Http\Controllers\API\ConsultancyFessController::class, 'updateTable'])->name('updateTable');
    Route::post('/updatedateteamcf', [App\Http\Controllers\API\ConsultancyFessController::class, 'updatedateteamcf'])->name('updatedateteamcf');
    Route::post('/updatedateteamcfdelete', [App\Http\Controllers\API\ConsultancyFessController::class, 'updatedateteamcfdelete'])->name('updatedateteamcfdelete');

    //16-01-2023
    Route::get('/getcfvalue/{sid}', [App\Http\Controllers\API\ConsultancyFessController::class, 'getcfvalue'])->name('getcfvalue');

    //17-01-2023
    Route::get('/getsalescfvalue/{cv}/{pv}/{pid}/{lid}', [App\Http\Controllers\API\ConsultancyFessController::class, 'getsalescfvalue'])->name('getsalescfvalue');

    //17-01-2023
    Route::get('/newrecordsaledetails', [App\Http\Controllers\API\ConsultancyFessController::class, 'newrecordsaledetails'])->name('newrecordsaledetails');
    Route::get('/updaterecordsaledetails', [App\Http\Controllers\API\ConsultancyFessController::class, 'updaterecordsaledetails'])->name('updaterecordsaledetails');

    //18-1-2023
    Route::post('/updatesaleids', [App\Http\Controllers\API\ConsultancyFessController::class, 'updatesaleids'])->name('updatesaleids');
    Route::get('/getsaledetailsdata', [App\Http\Controllers\API\ConsultancyFessController::class, 'getsaledetailsdata'])->name('getsaledetailsdata');
    ///////////Tl with payvoucher///////////

    /////change//
    Route::get('/getEmp/{id}', [App\Http\Controllers\API\UsersController::class, 'getEmp'])->name('getEmp');
    Route::get('/getEmpDatediff/{id}', [App\Http\Controllers\API\UsersController::class, 'getEmpDatediff'])->name('getEmpDatediff');
    Route::get('/Empfilter1/{id}', [App\Http\Controllers\API\MonthlyIncentiveController::class, 'Empfilter1'])->name('Empfilter1');
    Route::get('/Empfilter3/{id}', [App\Http\Controllers\API\HalfyearincentiveController::class, 'Empfilter3'])->name('Empfilter3');
    Route::get('/Empfilter4/{id}', [App\Http\Controllers\API\YearIncentiveController::class, 'Empfilter4'])->name('Empfilter4');
    Route::get('/Empfilter2/{id}', [App\Http\Controllers\API\QuarterlyIncentiveController::class, 'Empfilter2'])->name('Empfilter2');

    ///////////17-05-23///////////
    Route::get('/convertdate', [App\Http\Controllers\API\AttendanceController::class, 'convertdate'])->name('convertdate');
    Route::get('/getlastyear/{year}', [App\Http\Controllers\API\AttendanceController::class, 'getlastyear'])->name('getlastyear');
    Route::post('/updateatt', [App\Http\Controllers\API\AttendanceController::class, 'updateatt'])->name('updateatt');
    Route::get('/datafindtext', [App\Http\Controllers\API\UsersController::class, 'datafindtext'])->name('datafindtext');
    //23-05-2023
    Route::get('/invoice_multi_credit/{id}', [App\Http\Controllers\API\InvoicedetidsController::class, 'invoice_multi_credit'])->name('invoice_multi_credit');

    Route::post('/invoiceCreditNote', [App\Http\Controllers\API\CreditNoteController::class, 'invoiceCreditNote'])->name('invoiceCreditNote');
    //   Route::get('/datafindtext', [App\Http\Controllers\API\UsersController::class,'datafindtext'])->name('datafindtext');
    Route::post('/getRegionData', [App\Http\Controllers\API\ProjectsController::class, 'getRegionData'])->name('getRegionData');
    Route::post('/updateRegion', [App\Http\Controllers\API\ProjectsController::class, 'updateRegion'])->name('updateRegion');
    Route::post('/updateBulk', [App\Http\Controllers\API\ProjectsController::class, 'updateBulk'])->name('updateBulk');
    Route::post('/getSubRegionData', [App\Http\Controllers\API\ProjectsController::class, 'getSubRegionData'])->name('getSubRegionData');
    Route::post('/getProjectStatusData', [App\Http\Controllers\API\ProjectsController::class, 'getProjectStatusData'])->name('getProjectStatusData');

    //////////role-permission///////////
    ///////////data sharing/////////
    Route::post('/dataYearwiseLaccess2', [App\Http\Controllers\API\sharedRuleController::class, 'dataYearwiseLaccess2'])->name('dataYearwiseLaccess2');
    Route::post('/dataYearwiseLaccess1', [App\Http\Controllers\API\sharedRuleController::class, 'dataYearwiseLaccess1'])->name('dataYearwiseLaccess1');
    Route::post('/dataYearwiseLaccess', [App\Http\Controllers\API\sharedRuleController::class, 'dataYearwiseLaccess'])->name('dataYearwiseLaccess');

    Route::post('/dataMonthwiseLaccess2', [App\Http\Controllers\API\sharedRuleController::class, 'dataMonthwiseLaccess2'])->name('dataMonthwiseLaccess2');
    Route::post('/dataMonthwiseLaccess1', [App\Http\Controllers\API\sharedRuleController::class, 'dataMonthwiseLaccess1'])->name('dataMonthwiseLaccess1');
    Route::post('/dataMonthwiseLaccess', [App\Http\Controllers\API\sharedRuleController::class, 'dataMonthwiseLaccess'])->name('dataMonthwiseLaccess');
    Route::post('/dataWeekwiseLaccess2', [App\Http\Controllers\API\sharedRuleController::class, 'dataWeekwiseLaccess2'])->name('dataWeekwiseLaccess2');
    Route::post('/dataWeekwiseLaccess1', [App\Http\Controllers\API\sharedRuleController::class, 'dataWeekwiseLaccess1'])->name('dataWeekwiseLaccess1');
    Route::post('/dataWeekwiseLaccess', [App\Http\Controllers\API\sharedRuleController::class, 'dataWeekwiseLaccess'])->name('dataWeekwiseLaccess');

    Route::post('/dataTeamwiseLaccess2', [App\Http\Controllers\API\sharedRuleController::class, 'dataTeamwiseLaccess2'])->name('dataTeamwiseLaccess2');
    Route::post('/dataTeamwiseLaccess1', [App\Http\Controllers\API\sharedRuleController::class, 'dataTeamwiseLaccess1'])->name('dataTeamwiseLaccess1');
    Route::post('/dataTeamwiseLaccess', [App\Http\Controllers\API\sharedRuleController::class, 'dataTeamwiseLaccess'])->name('dataTeamwiseLaccess');

    Route::post('/dataEmpIncaccess', [App\Http\Controllers\API\sharedRuleController::class, 'dataEmpIncaccess'])->name('dataEmpIncaccess');
    Route::post('/datauserperfoaccess', [App\Http\Controllers\API\sharedRuleController::class, 'datauserperfoaccess'])->name('datauserperfoaccess');
    Route::post('/datawalkinaccess', [App\Http\Controllers\API\sharedRuleController::class, 'datawalkinaccess'])->name('datawalkinaccess');
    Route::post('/datadvanceEmiaccess', [App\Http\Controllers\API\sharedRuleController::class, 'datadvanceEmiaccess'])->name('datadvanceEmiaccess');
    Route::post('/datadvanceSalaccess', [App\Http\Controllers\API\sharedRuleController::class, 'datadvanceSalaccess'])->name('datadvanceSalaccess');
    Route::post('/datamonthlyaccess', [App\Http\Controllers\API\sharedRuleController::class, 'datamonthlyaccess'])->name('datamonthlyaccess');
    Route::post('/datattendanceaccess', [App\Http\Controllers\API\sharedRuleController::class, 'datattendanceaccess'])->name('datattendanceaccess');
    Route::post('/dataCreditaccess', [App\Http\Controllers\API\sharedRuleController::class, 'dataCreditaccess'])->name('dataCreditaccess');
    Route::post('/dataReciptaccess', [App\Http\Controllers\API\sharedRuleController::class, 'dataReciptaccess'])->name('dataReciptaccess');
    Route::post('/dataInvoiceaccess', [App\Http\Controllers\API\sharedRuleController::class, 'dataInvoiceaccess'])->name('dataInvoiceaccess');
    Route::post('/datachannelpartneraccess', [App\Http\Controllers\API\sharedRuleController::class, 'datachannelpartneraccess'])->name('datachannelpartneraccess');
    Route::post('/datauseraccess', [App\Http\Controllers\API\sharedRuleController::class, 'datauseraccess'])->name('datauseraccess');
    Route::get('/sharedRules/{user_id}', [App\Http\Controllers\API\sharedRuleController::class, 'sharedRules'])->name('sharedRules');
    //////*********permission////////// */
    Route::get('/checktabdesignations/{designation_id}', [App\Http\Controllers\API\RoleAccessController::class, 'checktabdesignations'])->name('checktabdesignations');
    Route::get('/prodesignations1/{designation_id}', [App\Http\Controllers\API\rolepermissionController::class, 'prodesignations1'])->name('prodesignations1');
    Route::post('/getdesignationperm1', [App\Http\Controllers\API\rolepermissionController::class, 'getdesignationperm1'])->name('getdesignationperm1');
    Route::post('/getdesignationperm', [App\Http\Controllers\API\RoleAccessController::class, 'getdesignationperm'])->name('getdesignationperm');
    Route::post('/rolestore', [App\Http\Controllers\API\RoleAccessController::class, 'rolestore'])->name('rolestore');
    Route::post('/prodesignations', [App\Http\Controllers\API\rolepermissionController::class, 'prodesignations'])->name('prodesignations');
    Route::get('/getUserRole', [App\Http\Controllers\API\UsersController::class, 'getUserRole'])->name('getUserRole');

    Route::get('/getPermissions/{designationId}', [App\Http\Controllers\API\rolepermissionController::class, 'getPermissions'])->name('getPermissions');
    Route::get('/usersRE', [App\Http\Controllers\API\UsersController::class, 'usersRE'])->name('usersRE');
    Route::get('/teamsdata', [App\Http\Controllers\API\WalkindealsController::class, 'teamsdata'])->name('teamsdata');
    Route::get('/teamleader', [App\Http\Controllers\API\WalkindealsController::class, 'teamleader'])->name('teamleader');
    Route::get('/tlmappeduser/{id}', [App\Http\Controllers\API\WalkindealsController::class, 'tlmappeduser'])->name('tlmappeduser');
    Route::get('/getallteamleaders/{id}', [App\Http\Controllers\API\WalkindealsController::class, 'getallteamleaders'])->name('getallteamleaders');
    Route::get('/userwisesorting/{id}', [App\Http\Controllers\API\DealdetailsController::class, 'userwisesorting'])->name('userwisesorting');
    Route::get('/teamleadersinform', [App\Http\Controllers\API\TeamleadersController::class, 'teamleadersinform'])->name('teamleadersinform');
    Route::patch('/updateCompDataForProject/{project_id}', [App\Http\Controllers\API\ProjectsController::class, 'updateCompDataForProject'])->name('updateCompDataForProject');
    Route::get('/showcompany/{project_id}', [App\Http\Controllers\API\ProjectsController::class, 'showcompany'])->name('showcompany');
    Route::post('/companydata', [App\Http\Controllers\API\ProjectsController::class, 'companydata'])->name('companydata');
    Route::patch('/Usergroupadd', [App\Http\Controllers\API\UsergroupController::class, 'Usergroupadd'])->name('Usergroupadd');
    Route::post('/getUserFilterData', [App\Http\Controllers\API\TeamdetailsController::class, 'getUserFilterData'])->name('getUserFilterData');
    Route::get('/getSharingData', [App\Http\Controllers\API\ReportUserController::class, 'getSharingData'])->name('getSharingData');
    Route::post('/updateUserGroup', [App\Http\Controllers\API\ReportUserController::class, 'updateUserGroup'])->name('updateUserGroup');
    Route::get('/getsharing', [App\Http\Controllers\API\ReportUserController::class, 'getsharing'])->name('getsharing');
    Route::get('/storeGroupUserData', [App\Http\Controllers\API\ReportUserController::class, 'storeGroupUserData'])->name('storeGroupUserData');
    Route::get('/getGroupUserData', [App\Http\Controllers\API\ReportUserController::class, 'getGroupUserData'])->name('getGroupUserData');
    Route::get('/getallUSR', [App\Http\Controllers\API\sharingaccessController::class, 'getallUSR'])->name('getallUSR');
    //Route::patch('/updatedata1', [App\Http\Controllers\API\UsergroupController::class,'updatedata1'])->name('updatedata1');
    Route::delete('/removeShareAccessEdit/{id}', [App\Http\Controllers\API\UsergroupController::class, 'removeShareAccessEdit'])->name('removeShareAccessEdit');
    Route::put('/replaceDataById/{id}', [App\Http\Controllers\API\UsergroupController::class, 'replaceDataById'])->name('replaceDataById');
    //Route::put('/data/update', 'UsergroupController@update');
    // Route::match(['put', 'patch'], '/data/update', 'UsergroupController@update');
    Route::post('/updateData', [App\Http\Controllers\API\UsergroupController::class, 'updateData'])->name('updateData');
    Route::get('/checkDataExists', [App\Http\Controllers\API\UsergroupController::class, 'checkDataExists'])->name('checkDataExists');
    Route::get('/updateUserEditData', [App\Http\Controllers\API\UsergroupController::class, 'updateUserEditData'])->name('updateUserEditData');
    //  Route::get('/update1', [App\Http\Controllers\API\UsergroupController::class,'update1'])->name('update1');
    Route::post('/updateUserGroup', [App\Http\Controllers\API\UsergroupController::class, 'updateUserGroup'])->name('updateUserGroup');
    Route::post('/getGroupMonth1', [App\Http\Controllers\API\UsergroupController::class, 'getGroupMonth1'])->name('getGroupMonth1');
    Route::post('/checkDataExists', [App\Http\Controllers\API\UsergroupController::class, 'checkDataExists'])->name('checkDataExists');
    Route::delete('/deleteByGroupId', [App\Http\Controllers\API\UsergroupController::class, 'deleteByGroupId'])->name('deleteByGroupId');
    Route::post('/checkDatauser', [App\Http\Controllers\API\UsergroupController::class, 'checkDatauser'])->name('checkDatauser');
    Route::post('/checkDatauser', [App\Http\Controllers\API\UsergroupController::class, 'checkDatauser'])->name('checkDatauser');
    Route::delete('/deleteValueAndAssociations', [App\Http\Controllers\API\ReportUserController::class, 'deleteValueAndAssociations'])->name('deleteValueAndAssociations');
    Route::get('/getallUSR', [App\Http\Controllers\API\sharingaccessController::class, 'getallUSR'])->name('getallUSR');
    Route::post('/getuserteam', [App\Http\Controllers\API\TeamdetailsController::class, 'getuserteam'])->name('getuserteam');
    Route::get('/gettickets', [App\Http\Controllers\API\TicketsController::class, 'index'])->name('gettickets.index');
    Route::post('/gettickets', [App\Http\Controllers\API\TicketsController::class, 'create'])->name('gettickets.create');
    Route::get('/gettickets/{id}', [App\Http\Controllers\API\TicketsController::class, 'getbyid'])->name('gettickets.getbyid');
    Route::patch('/updategettickets/{id}', [App\Http\Controllers\API\TicketsController::class, 'update'])->name('gettickets.update');
    Route::delete('/gettickets/{id}', [App\Http\Controllers\API\TicketsController::class, 'destroy'])->name('gettickets.destory');
    // Route::delete('/gettickets/{id}', [App\Http\Controllers\API\TicketsController::class, 'destroy'])->name('gettickets.destroy');
    Route::get('/allteamdata/{id}', [App\Http\Controllers\API\TicketsController::class, 'allteamdata'])->name('gettickets.allteamdata');
    Route::get('/getinvoicedata1/{company_id}', [App\Http\Controllers\API\CreditmultiController::class, 'getinvoicedata1'])->name('getinvoicedata1');
    Route::get('/getinvoicedata2/{id}', [App\Http\Controllers\API\CreditmultiController::class, 'getinvoicedata2'])->name('getinvoicedata2');
    Route::post('/updateTeamDetails/{id}', [App\Http\Controllers\API\TeamdetailsController::class, 'updateTeamDetails'])->name('updateTeamDetails');
    //22-09-2023
    Route::get('/activitylog', [App\Http\Controllers\ActivitylogsController::class, 'index'])->name('updatesdeatil');
    Route::get('/activitylog', [App\Http\Controllers\ActivitylogsController::class, 'getupdatesdeatil'])->name('updatesdeatil');
    Route::post('/activitylog', [App\Http\Controllers\ActivitylogsController::class, 'registercreate'])->name('updatesdeatil');
    Route::get('/activitylog/{id}', [App\Http\Controllers\ActivitylogsController::class, 'getidupdatesdeatil'])->name('updatesdeatil');
    Route::patch('/activitylog/{id}', [App\Http\Controllers\ActivitylogsController::class, 'updatemydata'])->name('updatesdeatil');
    Route::delete('/activitylog/{id}', [App\Http\Controllers\ActivitylogsController::class, 'deleteData'])->name('updatesdeatil');

    Route::get('/allteamdata/{id}', [App\Http\Controllers\API\TicketsController::class, 'allteamdata'])->name('gettickets.allteamdata');
    Route::get('/getinvoicedata1/{company_id}', [App\Http\Controllers\API\CreditmultiController::class, 'getinvoicedata1'])->name('getinvoicedata1');
    Route::post('/getinvoicedate', [App\Http\Controllers\API\CreditmultiController::class, 'getinvoicedate'])->name('getinvoicedate');
    Route::post('/getinvoicedata2', [App\Http\Controllers\API\CreditmultiController::class, 'getinvoicedata2'])->name('getinvoicedata2');
    Route::post('/getinvoicedataforCredit', [App\Http\Controllers\API\CreditdetailsController::class, 'getinvoicedataforCredit'])->name('getinvoicedataforCredit');

    Route::get('/getinvoicedata3', [App\Http\Controllers\API\CreditmultiController::class, 'getinvoicedata3'])->name('getinvoicedata3');
});

// ########################  This Routes defined by jatin (starts here)  ######################## //
// ########################  This Routes defined by jatin (starts here)  ######################## //
Route::get('/payment-history', [App\Http\Controllers\paymentHistoryController::class, 'getPaymentHistory'])->name('getPaymentHistory');
Route::get('/payment-history/{user_id}', [App\Http\Controllers\paymentHistoryController::class, 'getPaymentHistoryById'])->name('getPaymentHistoryById');
Route::post('/payment-history', [App\Http\Controllers\paymentHistoryController::class, 'createPaymentHistory'])->name('createPaymentHistory');
Route::post('/payment-history-each', [App\Http\Controllers\paymentHistoryEachController::class, 'createPaymentHistoryEach'])->name('createPaymentHistoryEach');
// ########################   This Routes defined by jatin (ends here)   ######################## //
// ########################   This Routes defined by jatin (ends here)   ######################## //

// ######################## This Routes defined by jatin (starts here) ######################## //
// ######################## This Routes defined by jatin (starts here) ######################## //
// get all invoice types
Route::apiResource('invoice_types', invoiceTypesController::class);
// get invoice_type_id of invoice using invoice_id
Route::get('/inv-type-id/{id}', [InvoiceMultiController::class, 'getInvTypeId'])->name('getInvTypeId');
// get all companies list by invoice type
Route::get('/get-companies-by-inv-type/{invType}', [DebtorcompanydetController::class, 'getCompanyByInvType'])->name('getCompanyByInvType');
// get invoice using invoice_id & invoice_type_id
Route::get('/invoice-multi/{id}/{invTypeId}', [InvoiceMultiController::class, 'getInvoice'])->name('getInvoice');
// get Realestate clients
Route::get('/get-realestate-clients/{id}', [InvoiceMultiController::class, 'getRealestateClients'])->name('getRealestateClients');
// get homeloans clients
Route::get('/get-homeloans-clients/{id}', [InvoiceMultiController::class, 'getHomeloansClients'])->name('getHomeloansClients');
//  get invoice's all type of statuses
Route::apiResource('inv_status', Inv_statusController::class);
//  check if invoice number available or not
Route::get('/invoice_exists/{num}', [InvoiceMultiController::class, 'invoiceNumExists'])->name('invoiceNumExists');
// get sale detail for invoice type = realestate by client_id
Route::get('/getsales/{id}', [SalesdetailsController::class, 'getsales'])->name('getsales');
//  get disb detail for invoice type = home loans by disb_id
Route::get('/get-disbursement/{id}', [InvoiceMultiController::class, 'getDisbursements'])->name('getDisbursements');
//  checks maximum payout value for sale for invoice type = realestate
Route::post('/check-max-payout', [InvoiceMultiController::class, 'checkMaxPayout'])->name('checkMaxPayout');
// invoice multi routes
Route::apiResource('invoice_multi', invoiceMultiController::class);
//  update invoice in invoice_multi table
Route::post('/update-invoice-multi', [InvoiceMultiController::class, 'updateInvoice'])->name('updateInvoice');
// invoicedetids routes
Route::apiResource('invoicedetids', InvoicedetidsController::class);
// updates invoice's each entry in invoicedetids table
Route::post('/update-invoice-detids', [InvoicedetidsController::class, 'updateInvoiceDetids'])->name('updateInvoiceDetids');
// ########################  This Routes defined by jatin (ends here)  ######################## //
// ########################  This Routes defined by jatin (ends here)  ######################## //

// ######################## This Routes defined by jatin (starts here) ######################## //
// ######################## This Routes defined by jatin (starts here) ######################## //

Route::apiResource('charts', ChartsController::class);

// get all tables list
Route::get('/get-table-list', [ChartsController::class, 'getTableList'])->name('getTableList');
Route::get('/get-related-table/{tableName}', [ChartsController::class, 'getRelatedTables'])->name('getRelatedTables');
// get all column list of a table
Route::get('/get-table-columns/{tableName}', [ChartsController::class, 'getTableColumns'])->name('getTableColumns');
Route::get('/get-table-columns-by-module/{moduleName}', [ChartsController::class, 'getTableColumnsByModuleName'])->name('getTableColumnsByModuleName');
// get Chart
Route::post('/get-chart', [ChartsController::class, 'getChart'])->name('getChart');
Route::post('/get-chart2', [ChartsController::class, 'getChart2'])->name('getChart2');
// ########################  This Routes defined by jatin (ends here)  ######################## //
// ########################  This Routes defined by jatin (ends here)  ######################## //

Route::post('/get-dashboard-chart', [SalesdetailsController::class, 'getDashboardChart'])->name('getDashboardChart');
