<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RolesController;
//use App\Http\Controllers\API\NewusersController;
use App\Http\Controllers\API\GroupsController;
use App\Http\Controllers\API\TeamsController;
use App\Http\Controllers\API\ProjectsController;
use App\Http\Controllers\API\SubprojectsController;
use App\Http\Controllers\API\RegionsController;
use App\Http\Controllers\API\SubregionsController;
use App\Http\Controllers\API\DesignationsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\API\UsersController;
use App\Http\Controllers\API\ProjectallocationsController;
use App\Http\Controllers\API\TeamStatusController;
use App\Http\Controllers\API\TeamleadersController;
use App\Http\Controllers\API\TeamdetailsController;
use App\Http\Controllers\API\EmpStatusController;
use App\Http\Controllers\API\DebtorcompanydetController;
use App\Http\Controllers\API\EmpCommentsController;
use App\Http\Controllers\API\EmpDocumentsController;
use App\Http\Controllers\API\BookingStatusController;
use App\Http\Controllers\API\PayoutStatusController;
use App\Http\Controllers\API\LeadsourceController;
use App\Http\Controllers\API\ClientdetailsController;
use App\Http\Controllers\API\ChannelpartnerController;
use App\Http\Controllers\API\SalesdetailsController;
use App\Http\Controllers\API\ClientpaymentscheduleController;
use App\Http\Controllers\API\SalesdocumentsController;
use App\Http\Controllers\API\SalescommentsController;
use App\Http\Controllers\API\ImageController;
use App\Http\Controllers\API\ReportsController;
use App\Http\Controllers\API\ModulesController;
use App\Http\Controllers\API\ModulefieldsController;
use App\Http\Controllers\API\MonthsController;

////////// SALARY MODULE ///////////////////////
use App\Http\Controllers\API\Salary\SalarypackageController;
use App\Http\Controllers\API\Salary\AdvancesalaryController;
use App\Http\Controllers\API\Salary\AdvanceemiController;
use App\Http\Controllers\API\Salary\MonthlytargetController;
use App\Http\Controllers\API\Salary\MonthlysalaryController;


////////// INVOICES MODULE ////////////////
use App\Http\Controllers\API\InvoiceController;
use App\Http\Controllers\API\Inv_StatusController;
use App\Http\Controllers\API\ReceiptDetailsController;
use App\Http\Controllers\API\CreditNoteController;
use App\Http\Controllers\API\GstFillingdetailsController;

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

Route::apiResource('emp_documents', EmpDocumentsController::class);

Route::apiResource('clientdetails', ClientdetailsController::class);

Route::apiResource('channelpartner', ChannelpartnerController::class);

Route::apiResource('booking_status', BookingStatusController::class);

Route::apiResource('payout_status', PayoutStatusController::class);

Route::apiResource('leadsource', LeadsourceController::class);

Route::apiResource('salesdetails', SalesdetailsController::class);

Route::apiResource('client_payment_schedule', ClientpaymentscheduleController::class);

Route::apiResource('sales_documents', SalesdocumentsController::class);

Route::apiResource('sales_comments', SalescommentsController::class);

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


/////////////  INOICES MODULE /////////////////

Route::apiResource('invoice', InvoiceController::class);
Route::apiResource('inv_status', Inv_StatusController::class);
Route::apiResource('receiptdetails', ReceiptDetailsController::class);
Route::apiResource('credit_note', CreditNoteController::class);
Route::apiResource('gst_fillingdetails', GstFillingDetailsController::class);




Route::group([

    'middleware' => 'api',

], function ($router) {

    Route::post('/login', [App\Http\Controllers\AuthController::class,'login'])->name('login');
    Route::post('/signup', [App\Http\Controllers\AuthController::class,'signup'])->name('signup');
    Route::get('/dropdownlist', [App\Http\Controllers\API\SalesdetailsController::class,'getTableColumns'])->name('getTableColumns');
    Route::get('/getSalesCount', [App\Http\Controllers\API\SalesdetailsController::class,'getSalesCount'])->name('getSalesCount');
    Route::get('/generate/{id}', [App\Http\Controllers\API\ReportsController::class,'generatereports'])->name('generatereports');
    Route::get('/getid', [App\Http\Controllers\API\ReportsController::class,'getid'])->name('getid');
    Route::get('/fields', [App\Http\Controllers\API\ModulefieldsController::class,'fields'])->name('fields');
    Route::get('/calculation', [App\Http\Controllers\API\ReportsController::class,'calculation'])->name('calculation');
    Route::get('/calsum/{id}', [App\Http\Controllers\API\ReportsController::class,'calsum'])->name('calsum');
    Route::get('/calavrg/{id}', [App\Http\Controllers\API\ReportsController::class,'calavrg'])->name('calavrg');
    // Route::post('logout', 'AuthController@logout');
    // Route::post('refresh', 'AuthController@refresh');
    // Route::post('me', 'AuthController@me');

});