<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class EstimaterequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $userid = Auth::user()->userid;

        if(Auth::user()->usertype == '13')
        {
        $estimatereq = DB::table('estimaterequests')
        ->select('*')
        ->get();

        $additionalestmasters = DB::table('aeadditionalestimates')
        ->select('*')
        ->groupBy('additionalestid')
        ->get();

        }
        else
        {
            $estimatereq = DB::table('estimaterequests')
        ->select('*')
        ->where("assigned_to",'=',$userid)
        ->get();

        $additionalestmasters = DB::table('aeadditionalestimates')
        ->select('*')
        ->where("qs_id",'=',$userid)
        ->groupBy('additionalestid')
        ->get();

        }

        $invID =0;
        $maxValue = DB::table('twoestimates')->groupBy('estid')->get()->count();
        // dd($maxValue);
        $invID=$maxValue+1;
        $invID = str_pad($invID, 3, '0', STR_PAD_LEFT);
        $estimateid="EST".$invID;


        $quantitysurveyor = DB::table('users')
        ->select('*')
        ->whereIn('role',[7,13])
        ->get();

        return view('pages.estimaterequest',compact('estimatereq','estimateid','quantitysurveyor','additionalestmasters'));
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

    public function assignquantity(Request $request)
    {
        $quantitysurveyorname = $request->quantitysurveyorname;
        $surveyorid = $request->surveyorid;

        DB::table('estimaterequests')
        ->select('*')
        ->where('id','=',$surveyorid)
        ->update([
            "assigned_to"=>$quantitysurveyorname,

            ]);
    }
}
