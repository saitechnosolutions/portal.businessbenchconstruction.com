<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DrawingController;
use App\Http\Controllers\EstimateController;
use App\Http\Controllers\LeadsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\ApiCreateAreaController;
use App\Http\Controllers\ApiDesignationController;
use App\Http\Controllers\ApiZoneController;
use App\Http\Controllers\ChecklistController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EstimateController2;
use App\Http\Controllers\EstimaterequestController;
use App\Http\Controllers\EstimateStagesController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\WorkcompleteController;
use App\Http\Controllers\EngineerController;
use App\Http\Controllers\ProcessofworkController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('pages.login');
})->middleware('guest')->name('login');

// Route::view('dashboard','pages.dashboard');
Route::view('user','pages.users')->middleware('auth');
Route::view('engineers','pages.engineers')->middleware('auth');
Route::view('drawings','pages.drawings')->middleware('auth');
Route::view('estimaterequest','pages.estimaterequest')->middleware('auth');

Route::resource('estimates', EstimateController::class)->middleware('auth');
Route::resource('drawings', DrawingController::class)->middleware('auth');
Route::POST('drawrequest', [DrawingController::class, 'drawrequest'])->middleware('auth');
Route::POST('replydraw', [DrawingController::class, 'replydraw'])->middleware('auth');
Route::GET('estimatedetails/{engid}/{clientid}',[EstimateController::class,'getestimate']);

Route::GET('clients',[ClientController::class,'getallclients'])->middleware('auth');
Route::GET('logout',[UserController::class,'logout']);


Route::POST('authendicate',[UserController::class,'authendicate']);
Route::GET('ovrlestimate/{estid}',[EstimateController::class,'overallestimate']);
Route::GET('stageone/{estid}',[EstimateController::class,'stageone']);
Route::GET('stagetwo/{estid}',[EstimateController::class,'stagetwo']);
Route::GET('stagethree/{estid}',[EstimateController::class,'stagethree']);
Route::GET('stagefour/{estid}',[EstimateController::class,'stagefour']);
Route::GET('stagefive/{estid}',[EstimateController::class,'stagefive']);
Route::GET('stagesix/{estid}',[EstimateController::class,'stagesix']);
Route::GET('stageseven/{estid}',[EstimateController::class,'stageseven']);
Route::GET('stageeight/{estid}',[EstimateController::class,'stageeight']);
Route::GET('stagenine/{estid}',[EstimateController::class,'stagenine']);
Route::GET('stageten/{estid}',[EstimateController::class,'stageten']);

Route::GET('stagepaid/{id}',[EstimateController::class,'stagepaid']);

Route::resource('package', PackageController::class)->middleware('auth');
Route::resource('leads',LeadsController::class)->middleware('auth');
Route::POST('saveLeads',[LeadsController::class,'saveLeads'])->middleware('auth');
Route::GET('clientdetails/{id}',[ClientController::class,'clientdetails'])->middleware('auth');
Route::GET('uploaddraw/{drawid}/{pactype}/{leadid}',[DrawingController::class,'uploaddraw'])->middleware('auth');
Route::POST('uploaddrawings',[DrawingController::class,'uploaddrawings'])->middleware('auth');
Route::GET('architechuploadstatus/{clientid}/{drawid}',[DrawingController::class,'architechuploadstatus'])->middleware('auth');
Route::GET('clientapprove/{id}',[DrawingController::class,'clientapprove'])->middleware('auth');

Route::GET('clientreject/{id}',[DrawingController::class,'clientreject'])->middleware('auth');
Route::GET('aeapprove/{id}',[DrawingController::class,'aeapprove'])->middleware('auth');
Route::GET('aereject/{id}',[DrawingController::class,'aereject'])->middleware('auth');
// Route for  createArea
Route::get("/areas", [ApiCreateAreaController::class, "index"])->middleware('auth');

// Route for  createZone
Route::get("/zones", [ApiZoneController::class, "index"])->middleware('auth');


//  Route for createdesignation
Route::get("designation", [ApiDesignationController::class, "index"])->middleware('auth');
Route::POST('estimaterequest',[EstimateController::class,"estimaterequest"])->middleware('auth');
Route::GET('createmainest/{engid}/{clientid}',[EstimateController::class,'createmainest'])->middleware('auth');
Route::POST('createMainestimate',[EstimateController::class,'createMainestimate'])->middleware('auth');
Route::GET('drawingdetails/{id}',[DrawingController::class,'drawingdetails'])->middleware('auth');
Route::GET('getleaddetails/{leadid}',[LeadsController::class,'getleaddetails'])->middleware('auth');
Route::GET('gethouserequirements/{leadid}',[LeadsController::class,'gethouserequirements'])->middleware('auth');
Route::GET('getfamilymembers/{leadid}',[LeadsController::class,'getfamilymembers'])->middleware('auth');
Route::GET('estimateview/{id}',[EstimateController2::class,'estimateview'])->middleware('auth');
Route::resource('estimatereq',EstimaterequestController::class)->middleware('auth');
ROute::GET('mainestimateview/{estid}',[EstimateController2::class,'getmainestimate'])->middleware('auth');
Route::GET('splitestimateview/{estid}/{stage}',[EstimateController2::class,'splitestimateview'])->middleware('auth');
Route::GET('additionalestview/{estid}',[EstimateController2::class,'additionalestview'])->middleware('auth');
Route::resource('stages',EstimateStagesController::class)->middleware('auth');
Route::POST('uploadstage',[EstimateStagesController::class,'uploadstage'])->middleware('auth');
Route::GET('geteditstage/{stageid}',[EstimateStagesController::class,'geteditstage'])->middleware('auth');
Route::POST('updatestage',[EstimateStagesController::class,'updatestage'])->middleware('auth');
Route::GET('stagedelete/{id}',[EstimateStagesController::class,'stagedelete'])->middleware('auth');
Route::POST('uploadestimates',[EstimateStagesController::class,'uploadestimates'])->middleware('auth');
Route::GET('majorestimateview/{estid}',[EstimateController2::class,'majorestimateview'])->middleware('auth');
Route::POST('paymentraise',[PaymentController::class,'paymentraise'])->middleware('auth');
Route::POST('paymentpaid',[PaymentController::class,'paymentpaid'])->middleware('auth');
Route::GET('paymentapprove/{stageid}/{estid}/{esttype}',[PaymentController::class,'paymentapprove'])->middleware('auth');
Route::GET('paymentdetails/{clientid}',[PaymentController::class,'paymentdetails'])->middleware('auth');
Route::GET('workcompletedetails/{clientid}',[WorkcompleteController::class,'workcompletedetails'])->middleware('auth');
Route::POST('imageupload',[WorkcompleteController::class,'imageupload'])->middleware('auth');
Route::GET('imageapprove/{id}',[WorkcompleteController::class,'imageapprove'])->middleware('auth');
Route::GET('imagereject/{id}',[WorkcompleteController::class,'imagereject'])->middleware('auth');
Route::GET('clientapproveimg/{id}',[WorkcompleteController::class,'clientapproveimg'])->middleware('auth');
Route::GET('clientrejectimg/{id}',[WorkcompleteController::class,'clientrejectimg'])->middleware('auth');
Route::POST('getleads',[LeadsController::class,'Getleads'])->middleware('auth');
Route::POST('addTempestimate',[EstimateController::class,'addTempestimate'])->middleware('auth');
Route::POST('saveestimate',[EstimateController::class,'saveestimate'])->middleware('auth');
Route::resource('dashboard',DashboardController::class)->middleware('auth')->middleware('auth');

Route::GET('/editestimate/{estid}',[EstimateController::class,'Editestimate']);
Route::POST('update_estimates',[EstimateController::class,'Updateestimate']);


// Gn

Route::POST('view_engineer',[EngineerController::class,'UpdateEngineer'])->middleware('auth');
Route::POST('edit_engineer',[EngineerController::class,'EditEngineer'])->middleware('auth');

Route::POST('get_users',[UserController::class,'GetUsers'])->middleware('auth');
Route::POST('edit_users',[UserController::class,'UserEdit'])->middleware('auth');

Route::GET('checklist/{clientid}',[ChecklistController::class,'checklist'])->middleware('auth');
Route::POST('savecomments',[ChecklistController::class,'savecomments'])->middleware('auth');
Route::GET('viewcomments/{stageid}/{descnum}/{clientid}/{estid}',[ChecklistController::class,'viewcomments'])->middleware('auth');
Route::POST('updatestatus',[ChecklistController::class,'updatestatus'])->middleware('auth');

Route::POST('lead_get',[LeadsController::class,'Leadsview']);
Route::POST('get_leads',[LeadsController::class,'Getleads'])->middleware('auth');
Route::POST('update_lead',[LeadsController::class,'LeadUpdate'])->middleware('auth');

Route::GET('lead_delete/{id}',[LeadsController::class,'DeleteLead'])->middleware('auth');

Route::GET('get_client/{id}',[ClientController::class,'ClientView'])->middleware('auth');
Route::POST('update_users',[ClientController::class,'UpdateClient'])->middleware('auth');
Route::POST('saveadditionalestimate',[EstimateController2::class,'saveadditionalestimate'])->middleware('auth');
Route::POST('assigntelecaller',[LeadsController::class,'assigntelecaller']);
Route::POST('assignae',[LeadsController::class,'assignae']);
Route::POST('changeleadstatus',[LeadsController::class,'changeleadstatus']);
Route::POST('assigndrawing',[DrawingController::class,'assigndrawing'])->middleware('auth');
Route::POST('assignquantity',[EstimaterequestController::class,'assignquantity'])->middleware('auth');
// Route::resources('processofworks',[ProcessofworkController::class,'processofworks']);
Route::GET('processofworks/{engid}/{clientid}',[ProcessofworkController::class,'processofworks']);
Route::view('processworks','pages.processofworks');
Route::POST('processimageupload',[ProcessofworkController::class,'processimageupload']);
Route::POST('assignengineer',[EngineerController::class,'assignengineer']);
Route::GET('forwardqs/{estid}/{stageid}/{id}/{esttype}',[EstimateController2::class,'forwardqs']);
Route::GET('forwardtogm/{estid}/{stageid}',[EstimateController2::class,'forwardtogm']);
Route::GET('approvegm/{estid}/{stageid}',[EstimateController2::class,'approvegm']);
Route::GET('approvepaybtn/{estid}/{stageid}/{id}/{esttype}',[EstimateController2::class,'approvepaybtn']);

//GN
Route::GET('completed_works',[DashboardController::class,'CompleteWorks'])->middleware('auth');
Route::POST('complete_work',[DashboardController::class,'AjaxComplete']);
Route::POST('area_view',[EngineerController::class,'Areaview']);
Route::POST('addLead',[LeadsController::class,'addLead']);
Route::POST('clientapproval',[ClientController::class,'clientapproval']);
Route::GET('leaddelete/{leadid}',[LeadsController::class,'leaddelete']);
Route::POST('updatenotificationstatus',[DashboardController::class,'updatenotificationstatus']);
Route::GET('clientapproveestimate/{id}',[EstimateController2::class,'clientapproveestimate']);
Route::GET('clientrejectestimate/{id}',[EstimateController2::class,'clientrejectestimate']);

Route::GET('paymentcreation/{engcode}/{clientcode}',[PaymentController::class,'paymentcreation']);
Route::GET('approveforclient/{estid}/{stageid}/{id}/{esttype}',[EstimateController2::class,'approveforclient']);
Route::GET('allimagesupload/{stageid}/{estid}',[WorkcompleteController::class,'allimagesupload']);
Route::GET('uploadaddtionalest/{addestid}',[EstimateController2::class,'uploadaddtionalest']);

Route::POST('saveadditionalest',[EstimateController2::class,'saveadditionalest'])->middleware('auth');
Route::GET('approveaddnest/{addiestid}/{clientid}',[EstimateController2::class,'approveaddnest']);
Route::GET('qsadditionalestview/{addiestid}',[EstimateController2::class,'qsadditionalestview']);
Route::GET('approveaddnestae/{addiestid}',[EstimateController2::class,'approveaddnestae']);
Route::GET('approveaddnestclient/{addiestid}',[EstimateController2::class,'approveaddnestclient']);
Route::GET('qsheadapproveestimate/{estid}',[EstimateController2::class,'qsheadapproveestimate']);
Route::GET('qsheadrejectestimate/{estid}',[EstimateController2::class,'qsheadrejectestimate']);
Route::GET('aeapproveestimate/{estid}',[EstimateController2::class,'aeapproveestimate']);
Route::POST('assignstructuraleng',[DrawingController::class,'assignstructuraleng']);
Route::GET('aerejectestimate/{estid}',[EstimateController2::class,'aerejectestimate']);
Route::GET('aerejectmainestimate/{estid}',[EstimateController2::class,'aerejectmainestimate']);
Route::GET('deletedrawing/{drawid}',[DrawingController::class,'deletedrawing']);
