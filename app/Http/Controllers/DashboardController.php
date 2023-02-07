<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->usertype == 4)
        {
            $clientinfo = DB::table('clients')
            ->select('*')
            ->where('clientcode','=',Auth::user()->userid)
            ->first();

            $start_date = date("d-m-Y", strtotime($clientinfo->projectstartdate));
            $end_date = date("d-m-Y", strtotime($clientinfo->expecteddate));

            $getestimateid = DB::table('twoestimates')
            ->select('*')
            ->where('engineerid','=',$clientinfo->engineercode)
            ->where('clientid','=',Auth::user()->userid)
            ->first();

            // @dd($getestimate);
        }
        else
        {
            $clientinfo = '';
            $getestimateid = '';
            $start_date ='';
            $end_date='';
        }

        if(Auth::user()->usertype == '3')
        {
            $clientcount = DB::table('clients')
            ->select('*')
            ->where('engineercode','=',Auth::user()->userid)
            ->get();

            $activeproject = DB::table('clients')
            ->select('*')
            ->where('engineercode','=',Auth::user()->userid)
            ->where('completed_status','=',null)
            ->get();

            $completedproject = DB::table('clients')
            ->select('*')
            ->where('engineercode','=',Auth::user()->userid)
            ->where('completed_status','=','100')
            ->get();

             $estimatecount = DB::table('estimaterequests')
            ->select('*')
            ->where('engineerid','=',Auth::user()->userid)
            ->get();

           $completionofworks = DB::table('completionofworks')
            ->select('*')
            ->where('engcode','=',Auth::user()->userid)
            ->get();

            $leadscount2 = DB::connection('mysql2')->table('website_leads')
            ->select('*')
            ->where('ae_assign_id','=',Auth::user()->userid)
            ->get();

            // $leadscount = $l->count();

            // dd($leadscount1);

        }
        else
        {
            $clientcount = '';
            $activeproject = '';
            $completedproject = '';
            $estimatecount = '';
            $completionofworks = '';
            $start_date ='';
            $end_date='';
            $leadscount2='';
        }

        if(Auth::user()->usertype == '11')
        {
            $clientcount2 = DB::table('clients')
            ->select('*')
            ->where('engineercode','=',Auth::user()->userid)
            ->get();


            $leadscount2 = DB::connection('mysql2')->table('website_leads')
            ->select('*')
            ->get();

            // $leadscount = $l->count();

            // dd($leadscount1);

        }
        else
        {
            $clientcount2 = '';






        }

        if(Auth::user()->usertype == '12')
        {
            $leadscount5 = DB::connection('mysql2')->table('website_leads')
            ->select('*')
            ->get()
            ->count();
            // dd($leadscount3);
        }
        else
        {
            $leadscount5 ='0';
        }
        if(Auth::user()->usertype == '2')
        {
            $leadscount1 = DB::connection('mysql2')->table('website_leads')
            ->select('*')
            ->where('telecaller_assign_id','=',Auth::user()->userid)
            ->get();
        }
        else
        {
            $leadscount1 ='';
        }

        return view('pages.dashboard',compact('start_date','end_date','clientinfo','getestimateid','clientcount','activeproject','completedproject','estimatecount','completionofworks','leadscount1','leadscount2','leadscount5'));
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

    // GN

    public function CompleteWorks(){

        $works = DB::table('clients')
            ->where("clients.completed_status","=",100)
            ->get();
        return view("pages.complete_works",compact('works'));
    }

    public function AjaxComplete(){
        $engid = $_POST['work_id'];
        $client_data = DB::table('clients')
        ->where("engineercode","=",$engid)
        ->first();

        $lead_data = DB::table('leads')
        ->where("engineerid","=",$engid)
        ->first();

        $complete_data = DB::table('completionofworks')
        ->where("engcode","=",$engid)
        ->where("client_status","=",1)
        ->get();

        return view("pages.render_completed",compact('client_data','lead_data','complete_data'))->render();
    }


    public function updatenotificationstatus(Request $request)
    {
        $userid = Auth::user()->userid;

        $statusupdate =DB::table('notifications')
        ->select('*')
        ->where('notificationview','=',$userid)
        ->update([
            "notificationstatus"=>1
        ]);

        return $statusupdate;
    }
}
