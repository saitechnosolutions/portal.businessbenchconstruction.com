<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class EstimateController2 extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function estimateview($clientid)
    {
        $authengid = Auth::user()->userid;
        $authclientid = Auth::user()->userid;

        $getengid = DB::table('clients')
        ->select('*')
        ->where('clientcode','=',$authclientid)
        ->first();

        if(Auth::user()->usertype == '3')
        {
            $estimaterequests = DB::table('estimaterequests')
            ->select('*')
            ->where('clientid','=',$clientid)
            ->where('engineerid','=',$authengid)
            ->first();
        }
         $estimaterequests = DB::table('estimaterequests')
            ->select('*')
            ->where('clientid','=',$clientid)
            ->first();
        if(Auth::user()->usertype == '4')
        {
            $estimaterequests = DB::table('estimaterequests')
            ->select('*')
            ->where('clientid','=',$clientid)
            ->where('engineerid','=',$getengid->engineercode)
            ->first();
        }


        return view('pages.estimateview',compact('clientid','estimaterequests'));
    }

    public function getmainestimate($estid)
    {
        // $getestimatedetails = DB::table('stages')
        // ->select('*')
        // ->where('estid','=',$estid)
        // ->get();

        $stages = DB::table('twoestimates')
        ->select('*')
        ->where('estid','=',$estid)
        ->get();

        $totamt = DB::table('stages')
        ->select('*')
        ->where('estid','=',$estid)
        ->sum('amt');

        return view('pages.mainestimate',compact('stages','estid','totamt'));
    }

    public function splitestimateview($estid,$stage)
    {
        $getestimatedetails = DB::table('stages')
        ->select('*')
        ->where('estid','=',$estid)
        ->where('stage_num','=',$stage)
        ->get();

        $totamt = DB::table('stages')
        ->select('*')
        ->where('estid','=',$estid)
        ->where('stage_num','=',$stage)
        ->sum('amt');

        $rentationamt = DB::table('stages')
        ->select('*')
        ->where('estid','=',$estid)
        ->where('stage_num','=',$stage)
        ->sum('rentation_amt');


        return view('pages.splitestimateview',compact('getestimatedetails','estid','totamt','rentationamt','stage'));
    }


    public function majorestimateview($estid)
    {
        $getestimatedetails = DB::table('stages')
        ->select('*')
        ->where('estid','=',$estid)
        ->get();

        $totamt = DB::table('stages')
        ->select('*')
        ->where('estid','=',$estid)
        ->sum('amt');

        return view('pages.majorestimateview',compact('getestimatedetails','estid','totamt'));
    }


    public function saveadditionalestimate(Request $request)
    {
        $clientcode = $request->clientcode;
        $engineercode = $request->engineercode;
        $additionaltitle = $request->additionaltitle;

        $getqs = DB::table('estimaterequests')
        ->select('*')
        ->where('clientid','=',$clientcode)
        ->first();

        $getrm = DB::table('clients')
        ->select('*')
        ->where('clientcode','=',$getqs->clientid)
        ->first();

         $stagetendesc = $request->stagetendesc;

         $invID =0;
            $maxValue = DB::table('additionalestmasters')->groupBy('additionalestid')->get()->count();
            // dd($maxValue);
            $invID=$maxValue+1;
            $invID = str_pad($invID, 3, '0', STR_PAD_LEFT);
            $estid="ESTADDN".$invID;

        if($stagetendesc != '')
        {
            foreach($stagetendesc as $key => $stagetendesc)
            {
                // $stage1qty = $request->stagetenqty[$key];
                // $stage1unit = $request->stagetenunit[$key];
                $stage1desc = $request->stagetendesc[$key];
                // $stage1rate = $request->stagetenrate[$key];
                // $stage1per = $request->stagetenper[$key];
                $stage1amt = $request->stagetenamt[$key];

               $estimate = DB::table('aeadditionalestimates')
                ->insert([
                    "engineerid"=>$engineercode,
                    "clientid"=>$clientcode,
                    "additionalestid"=>$estid,
                    "additionalesttitle"=>$additionaltitle,
                    "description"=>$stage1desc,
                    // "qty"=>$stage1qty,
                    // "rate"=>$stage1rate,
                    // "unit"=>$stage1unit,
                    // "per"=>$stage1per,
                    "approval_status"=>1,
                    "amount"=>$stage1amt,
                    "qs_id"=>$getqs->assigned_to
                ]);
            }
        }

        DB::table('notifications')
        ->select('*')
        ->insert([
            "notificationview" => $getqs->assigned_to,
            "notificationstatus" =>0,
            "purposeid"=>$estid,
            "purposename" => "$engineercode Requested Additional Estimate for $clientcode Additional Estimate ID is $estid"
        ]);

        DB::table('notifications')
        ->select('*')
        ->insert([
            "notificationview" => $getrm->rmid,
            "notificationstatus" =>0,
            "purposeid"=>$estid,
            "purposename" => "$engineercode Requested Additional Estimate for $clientcode Additional Estimate ID is $estid"
        ]);


        return $estimate;
    }


    public function additionalestview($estid)
    {
        $getestimatedetails = DB::table('aeadditionalestimates')
        ->select('*')
        ->where('additionalestid','=',$estid)
        ->get();

        // dd($getestimatedetails);
         $totamt = DB::table('aeadditionalestimates')
        ->select('*')
        ->where('additionalestid','=',$estid)
        ->sum('amount');

        return view('pages.additionalestview',compact('getestimatedetails','estid','totamt'));

    }


    public function forwardqs($estid,$stageid,$id,$esttype)
    {
        DB::table('payments')
        ->select('*')
        ->where('estimateid','=',$estid)
        ->where('stageid','=',$stageid)
        ->where('id','=',$id)
        ->update([
            "approval_status"=>1
        ]);

        // $getdetails = DB::table('estimaterequests')
        // ->select('*')
        // ->where('estimate_id','=',$estid)
        // ->first();

        if($esttype == 0)
        {
            $getdetails = DB::table('twoestimates')
            ->select('*')
            ->where('estid','=',$estid)
            ->first();

            $engid = $getdetails->engineerid;
        }
        else
        {
            $getdetails = DB::table('payments')
            ->select('*')
            ->where('estimateid','=',$estid)
            ->first();

            $engid = $getdetails->engid;
        }

        // dd($getdetails);
        $getrmid = DB::table('clients')
        ->select('*')
        ->where('clientcode','=',$getdetails->clientid)
        ->first();

        DB::table('notifications')
            ->insert([
                "notificationview"=>$getdetails->clientid,
                "purposeid"=>$estid,
                "purposename"=>"Estimate ID $estid Stage ID $stageid Quantity Surveyor Reviewed the estimate"
            ]);

        DB::table('notifications')
          ->insert([
            "notificationview"=>$getrmid->rmid,
            "purposeid"=>$estid,
            "purposename"=>"Client ID $getdetails->clientid Estimate ID $estid Stage ID $stageid Quantity Surveyor Reviewed the estimate"
          ]);

          DB::table('notifications')
          ->insert([
            "notificationview"=>$engid,
            "purposeid"=>$estid,
            "purposename"=>"Client ID $getdetails->clientid Estimate ID $estid Stage ID $stageid Quantity Surveyor Reviewed the estimate"
          ]);

          $qshead = DB::table('users')
            ->select('*')
            ->where('role','=',13)
            ->first();

            DB::table('notifications')
            ->insert([
                "notificationview"=>$qshead->userid,
                "purposeid"=>$estid,
                "purposename"=>"Client ID $getdetails->clientid Estimate ID $estid Stage ID $stageid Quantity Surveyor Reviewed the estimate"
            ]);


    }

    public function forwardtogm($estid,$stageid)
    {
        DB::table('payments')
        ->select('*')
        ->where('estimateid','=',$estid)
        ->where('stageid','=',$stageid)
        ->update([
            "approval_status"=>2
        ]);
    }

    public function approvegm($estid,$stageid)
    {
        DB::table('payments')
        ->select('*')
        ->where('estimateid','=',$estid)
        ->where('stageid','=',$stageid)
        ->update([
            "approval_status"=>3
        ]);
    }

    public function approvepaybtn($estid,$stageid,$id,$esttype)
    {
        DB::table('payments')
        ->select('*')
        ->where('estimateid','=',$estid)
        ->where('stageid','=',$stageid)
        ->where('id','=',$id)
        ->update([
            "approval_status"=>4,
            "payment_status"=>1,
        ]);

        if($esttype == 0)
        {
            $getclient = DB::table('twoestimates')
            ->select('*')
            ->where('estid','=',$estid)
            ->first();

            $engid = $getclient->engineerid;
        }
        else
        {
            $getclient = DB::table('payments')
            ->select('*')
            ->where('estimateid','=',$estid)
            ->first();

            $engid = $getclient->engid;
        }

        // $getclient = DB::table('estimaterequests')
        // ->select('*')
        // ->where('estimate_id','=',$estid)
        // ->first();

        $getrmid = DB::table('clients')
        ->select('*')
        ->where('clientcode','=',$getclient->clientid)
        ->first();

        DB::table('notifications')
          ->insert([
            "notificationview"=>$getrmid->rmid,
            "purposeid"=>$stageid,
            "purposename"=>"AE Approved the payment for $getclient->clientid Stage ID $stageid"
          ]);

          DB::table('notifications')
          ->insert([
            "notificationview"=>$getclient->clientid,
            "purposeid"=>$stageid,
            "purposename"=>"$stageid AE Approve your payment"
          ]);
    }

    public function clientapproveestimate($id)
    {
        $estid = DB::table('estimaterequests')
        ->select('*')
        ->where('clientid','=',$id)
        ->first();

        $estimaterequest = DB::table('estimaterequests')
        ->select('*')
        ->where('clientid','=',$id)
        ->update([
            "admin_status"=>2
            ]);

            DB::table('notifications')
            ->insert([
                "notificationview"=>$estid->engineerid,
                "purposeid"=>$estid->estimate_id,
                "purposename"=>"Estimate Approve for Client"
            ]);

        $paymentcreation = DB::table('stages')
        ->select('*')
        ->where('estid','=',$estid->estimate_id)
        ->groupBy('stage_num')
        ->get();
        $j=1;
        // dd($paymentcreation);
        foreach($paymentcreation as $create)
        {

            for ($i = 0; $i < $create->paymentsplit; $i++) {
                DB::table('payments')
                ->insert([
                    "estimateid"=>$create->estid,
                    "stageid"=>$create->stage_num,
                    "payamount"=>$create->dueamount,
                    "clientid"=>$id,
                    "engid"=>$estid->engineerid,
                    "paymentsno"=>$j++
                ]);

            }
        }

        // $minid = DB::table('payments')
        // ->select('id')
        // ->where('estimateid','=',$estid->estimate_id)
        // ->first();

        $minid = DB::table('payments')
        ->select('id')
        ->where('estimateid','=',$estid->estimate_id)
        ->orderBy('id','asc')
        ->take(2)
        ->get();

        foreach($minid as $m)
        {
            DB::table('payments')
            ->select('*')
            ->where('id','=',$m->id)
            ->update([
                "approval_status"=>6
            ]);
        }



        return $estimaterequest;
    }


    public function clientrejectestimate($id)
    {
        $estimaterequest = DB::table('estimaterequests')
        ->select('*')
        ->where('clientid','=',$id)
        ->update([
            "admin_status"=>6
            ]);

            $getae = DB::table('estimaterequests')
            ->select('*')
            ->where('clientid','=',$id)
            ->first();

            DB::table('notifications')
            ->insert([
                "notificationview"=>$getae->engineerid,
                "purposeid"=>$getae->estimate_id,
                "purposename"=>"Estimate Reject for Client"
            ]);

    }

    public function approveforclient($estid,$stageid,$id,$esttype)
    {
        DB::table('payments')
        ->select('*')
        ->where('estimateid','=',$estid)
        ->where('stageid','=',$stageid)
        ->where('id','=',$id)
        ->update([
            "approval_status"=>2
        ]);

        if($esttype == 0)
        {
            $getdetails = DB::table('twoestimates')
            ->select('*')
            ->where('estid','=',$estid)
            ->first();

            $engid = $getdetails->engineerid;
        }
        else
        {
            $getdetails = DB::table('payments')
            ->select('*')
            ->where('estimateid','=',$estid)
            ->first();

            $engid = $getdetails->engid;
        }

        // $getdetails = DB::table('estimaterequests')
        // ->select('*')
        // ->where('estimate_id','=',$estid)
        // ->first();
        // dd($getdetails);
        $getrmid = DB::table('clients')
        ->select('*')
        ->where('clientcode','=',$getdetails->clientid)
        ->first();

        DB::table('notifications')
            ->insert([
                "notificationview"=>$getdetails->clientid,
                "purposeid"=>$estid,
                "purposename"=>"Estimate ID $estid Stage ID $stageid Quantity Surveyor Head Reviewed Pay the amount"
            ]);

        DB::table('notifications')
          ->insert([
            "notificationview"=>$getrmid->rmid,
            "purposeid"=>$estid,
            "purposename"=>"Client ID $getdetails->clientid Estimate ID $estid Stage ID $stageid Quantity Surveyor Head Reviewed the estimate"
          ]);

          DB::table('notifications')
          ->insert([
            "notificationview"=>$engid,
            "purposeid"=>$estid,
            "purposename"=>"Client ID $getdetails->clientid Estimate ID $estid Stage ID $stageid Quantity Surveyor Head Reviewed the estimate"
          ]);

    }

    public function uploadaddtionalest($addestid)
    {

        $aeadditionalestimates = DB::table('aeadditionalestimates')
        ->select('*')
        ->where('additionalestid','=',$addestid)
        ->get();
        return view('pages.uploadaddtionalest',compact('addestid','aeadditionalestimates'));
    }

    public function saveadditionalest(Request $request)
    {
        $clientcode = $request->clientid;
        $engineercode = $request->engineerid;
        $additionalestid = $request->additionalestid;

        $getqs = DB::table('estimaterequests')
        ->select('*')
        ->where('clientid','=',$clientcode)
        ->first();

        $getrm = DB::table('clients')
        ->select('*')
        ->where('clientcode','=',$clientcode)
        ->first();

         $stageqty = $request->stageqty;
        // dd($stageqty);


        if($stageqty != '')
        {
            foreach($stageqty as $key => $stageqty)
            {
                $stage1qty = $request->stageqty[$key];
                $stage1unit = $request->stageunit[$key];
                $stage1desc = $request->stagedesc[$key];
                $stage1rate = $request->stagerate[$key];
                // $stage1per = $request->stagetenper[$key];
                $stage1amt = $request->stageamt[$key];

               $estimate = DB::table('additionalestmasters')
                ->insert([
                    "engineerid"=>$engineercode,
                    "clientid"=>$clientcode,
                    "additionalestid"=>$additionalestid,
                    "description"=>$stage1desc,
                    "qty"=>$stage1qty,
                    "rate"=>$stage1rate,
                    "unit"=>$stage1unit,
                    // "per"=>$stage1per,
                    "approval_status"=>2,
                    "amount"=>$stage1amt,
                    "qs_id"=>$getqs->assigned_to,
                    "stagetotamt"=>$request->stagetotamt,
                    "clientpercentage"=>$request->clientpercentage,
                    "clientestimateamt"=>$request->clientestimateamt,
                    "paymentsplit"=>$request->paymentsplit,
                    "dueamount"=>$request->dueamount
                ]);
            }
        }
        DB::table('aeadditionalestimates')
        ->select('*')
        ->where('additionalestid','=',$additionalestid)
        ->update([
            "approval_status"=>2
        ]);

        DB::table('notifications')
        ->select('*')
        ->insert([
            "notificationview" => $engineercode,
            "notificationstatus" =>0,
            "purposeid"=>$additionalestid,
            "purposename" => "$getqs->assigned_to Providing Additional Estimate for $clientcode"
        ]);

        DB::table('notifications')
        ->select('*')
        ->insert([
            "notificationview" => $getrm->rmid,
            "notificationstatus" =>0,
            "purposeid"=>$additionalestid,
            "purposename" => "$getqs->assigned_to Providing Additional Estimate for $clientcode"
        ]);


        return $estimate;
    }


    public function approveaddnest($addiestid,$clientid)
    {
        $approveaddnest = DB::table('aeadditionalestimates')
        ->select('*')
        ->where('additionalestid','=',$addiestid)
        ->update([
            "approval_status"=>3
        ]);

        $getdetails = DB::table('clients')
        ->select('*')
        ->where('clientcode','=',$clientid)
        ->first();

        DB::table('notifications')
        ->select('*')
        ->insert([
            "notificationview" => $getdetails->engineercode,
            "notificationstatus" =>0,
            "purposeid"=>$addiestid,
            "purposename" => "$addiestid Approve the estimate for QS Head or GM"
        ]);

        DB::table('notifications')
        ->select('*')
        ->insert([
            "notificationview" => $getdetails->rmid,
            "notificationstatus" =>0,
            "purposeid"=>$addiestid,
            "purposename" => "$addiestid Approve the estimate for QS Head or GM"
        ]);

        return $approveaddnest;
    }

    public function qsadditionalestview($addiestid)
    {
        $qsadditionalestimates = DB::table('additionalestmasters')
        ->select('*')
        ->where('additionalestid','=',$addiestid)
        ->get();
        return view('pages.qsadditionalestview',compact('addiestid','qsadditionalestimates'));
    }

    public function approveaddnestae($addiestid)
    {
        $addnest = DB::table('additionalestmasters')
        ->select('*')
        ->where('additionalestid','=',$addiestid)
        ->update([
            "approval_status"=>4
        ]);

        $aeaddnest = DB::table('aeadditionalestimates')
        ->select('*')
        ->where('additionalestid','=',$addiestid)
        ->update([
            "approval_status"=>4
        ]);

        $getclientid = DB::table('aeadditionalestimates')
        ->select('*')
        ->where('additionalestid','=',$addiestid)
        ->first();

        DB::table('notifications')
        ->select('*')
        ->insert([
            "notificationview" => $getclientid->clientid,
            "notificationstatus" =>0,
            "purposeid"=>$addiestid,
            "purposename" => "$addiestid Your Additional Estimate Created Please check and Approve the estimate"
        ]);

        return $aeaddnest;

    }



    public function approveaddnestclient($addiestid)
    {
        $addnest = DB::table('additionalestmasters')
        ->select('*')
        ->where('additionalestid','=',$addiestid)
        ->update([
            "approval_status"=>5
        ]);

        $aeaddnest = DB::table('aeadditionalestimates')
        ->select('*')
        ->where('additionalestid','=',$addiestid)
        ->update([
            "approval_status"=>5
        ]);

        $getclientid = DB::table('aeadditionalestimates')
        ->select('*')
        ->where('additionalestid','=',$addiestid)
        ->first();
        $getdetail = DB::table('clients')
        ->select('*')
        ->where('clientcode','=',$getclientid->clientid)
        ->first();

        DB::table('notifications')
        ->select('*')
        ->insert([
            "notificationview" => $getdetail->engineercode,
            "notificationstatus" =>0,
            "purposeid"=>$addiestid,
            "purposename" => "$getdetail->clientcode Client Approve the Additional Estimate $addiestid"
        ]);

        DB::table('notifications')
        ->select('*')
        ->insert([
            "notificationview" => $getdetail->rmid,
            "notificationstatus" =>0,
            "purposeid"=>$addiestid,
            "purposename" => "$getdetail->clientcode Client Approve the Additional Estimate $addiestid"
        ]);

        $getaddnest = DB::table('additionalestmasters')
        ->select('*')
        ->where('additionalestid','=',$addiestid)
        ->first();


        $payments = DB::table('payments')
        ->insert([
            "estimateid"=>$addiestid,
            "payamount"=>$getaddnest->clientestimateamt,
            "stageid"=>"$addiestid Additional Estimate",
            "payment_status"=>0,
            "engid"=>$getaddnest->engineerid,
            "clientid"=>$getaddnest->clientid,
            "esttype"=>1,
            "approval_status"=>6
        ]);
        return $aeaddnest;

    }

    public function qsheadapproveestimate($estid)
    {
        DB::table('estimaterequests')
        ->select('*')
        ->where('estimate_id','=',$estid)
        ->update([
            "admin_status"=>3
        ]);
    }

    public function qsheadrejectestimate($estid)
    {
        DB::table('estimaterequests')
        ->select('*')
        ->where('estimate_id','=',$estid)
        ->update([
            "admin_status"=>7
        ]);
    }

    public function aeapproveestimate($estid)
    {
        DB::table('estimaterequests')
        ->select('*')
        ->where('estimate_id','=',$estid)
        ->update([
            "admin_status"=>4
        ]);
    }

    public function aerejectmainestimate($estid)
    {
        DB::table('estimaterequests')
        ->select('*')
        ->where('estimate_id','=',$estid)
        ->update([
            "admin_status"=>5
        ]);

        $getqs = DB::table('estimaterequests')
        ->select('*')
        ->where('estimate_id','=',$estid)
        ->first();

        $getqshead = DB::table('users')
        ->select('*')
        ->where('role','=',18)
        ->first();

        DB::table('notifications')
        ->select('*')
        ->insert([
            "notificationview" => $getqs->assigned_to,
            "notificationstatus" =>0,
            "purposeid"=>$estid,
            "purposename" => "$estid Reject for AE"
        ]);
    }



    public function aerejectestimate($addnestid)
    {


        $approveaddnest = DB::table('aeadditionalestimates')
        ->select('*')
        ->where('additionalestid','=',$addnestid)
        ->update([
            "approval_status"=>1
        ]);

        $getqshead = DB::table('users')
        ->select('*')
        ->where('role','=',18)
        ->first();

        DB::table('notifications')
        ->select('*')
        ->insert([
            "notificationview" => $getqshead->userid,
            "notificationstatus" =>0,
            "purposeid"=>$addnestid,
            "purposename" => "$addnestid Reject for AE"
        ]);

        $getgm = DB::table('users')
        ->select('*')
        ->where('role','=',11)
        ->first();

        DB::table('notifications')
        ->select('*')
        ->insert([
            "notificationview" => $getgm->userid,
            "notificationstatus" =>0,
            "purposeid"=>$addnestid,
            "purposename" => "$addnestid Reject for AE"
        ]);
    }
}



