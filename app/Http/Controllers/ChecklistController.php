<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChecklistController extends Controller
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

    public function checklist($clientid)
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
            // dd($estimaterequests);
        
        if(Auth::user()->usertype == '4')
        {
            $estimaterequests = DB::table('estimaterequests')
            ->select('*')
            ->where('clientid','=',$clientid)
            ->where('engineerid','=',$getengid->engineercode)
            ->first();    
        }

        return view('pages.checklist',compact('estimaterequests','clientid'));
    }


    public function savecomments(Request $request)
    {
        $clientcode = $request->clientcode;
        $estid = $request->estid;
        $stageid = $request->stageid;
        $descid = $request->descid;
        $checklistdesc = $request->checklistdesc;

        $savecomments = DB::table('checklistcomments')
        ->insert([
            "clientcode" => $clientcode,
            "estid" => $estid,
            "stageid" => $stageid,
            "descid" => $descid,
            "comments" => $checklistdesc,
        ]);

        return $savecomments;

    }

    public function viewcomments($stageid,$descnum,$clientid,$estid)
    {
        $getcomments = DB::table('checklistcomments')
        ->select('*')
        ->where('clientcode','=',$clientid)
        ->where('descid','=',$descnum)
        ->where('stageid','=',$stageid)
        ->where('estid','=',$estid)
        ->get();

        // dd($getcomments);
        return $getcomments;
    }

    public function updatestatus(Request $request)
    {
        $clientcode = $request->clientcode;
        $estid = $request->estid;
        $stageid = $request->stageid;
        $descid = $request->descid;
        $status = $request->status;

        $updatestatus = DB::table('stages')
        ->select('*')
        ->where('estid','=',$estid)
        ->where('stage_num','=',$stageid)
        ->where('id','=',$descid)
        ->update([
            "completed_status" => $status
        ]);

        $getstagecount = DB::table('stages')
        ->select('*')
        ->where('estid','=',$estid)
        ->get()
        ->count();

        $getcompletedworks = DB::table('stages')
        ->select('*')
        ->where('estid','=',$estid)
        ->where('completed_status','=','1')
        ->get()
        ->count();

        $percentage = $getstagecount/$getcompletedworks*100;

        if($percentage == '100')
        {
            $updatestatus = DB::table('clients')
            ->select('*')
            ->where('clientcode','=',$clientcode)
            ->update([
                "completed_status" => $percentage
            ]);
        }


        return $updatestatus;
    }
}
