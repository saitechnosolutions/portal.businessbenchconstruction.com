<?php

namespace App\Http\Controllers;

use App\Imports\EstimatesImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\StageMasterImport;
use Illuminate\Support\Facades\DB;
use App\Imports\StagesEstimatesImport;
use App\Imports\UploadedEstimateImport;

class EstimateStagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stages = DB::table('stagemasters')
        ->select('*')
        ->get();

        return view('pages.estimatestages',compact('stages'));
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

    public function uploadstage(Request $request)
    {
        Excel::import(new StageMasterImport, $request->file("import_stage"));
        // return $upload;

    }

    public function geteditstage($stageid)
    {
        $stageedit = DB::table('stagemasters')
        ->select('*')
        ->where('id','=',$stageid)
        ->first();

        return $stageedit;

    }

    public function updatestage(Request $request)
    {
        $stageid = $request->stageid;
        $stagename = $request->stagename;
        $description = $request->description;
        $id = $request->id;

        $update = DB::table('stagemasters')
        ->select('*')
        ->where('id','=',$id)
        ->update([
            "stageid"=>$stageid,
            "stagename"=>$stagename,
            "description"=>$description
        ]);

        return $update;
    }


    public function stagedelete($id)
    {
        DB::table('stagemasters')
        ->select('*')
        ->where('id','=',$id)
        ->delete();
    }

    public function uploadestimates(Request $request)
    {
        $engid = $request->engid;
        $clientid = $request->clientid;
        $estid = $request->estid;

        $estimatecount = DB::table('uploadedestimates')
        ->select('*')
        ->where('clientid','=',$clientid)
        ->where('engid','=',$engid)
        ->count();

        // dd($estimatecount);

        if($estimatecount == 0)
        {
            $import = Excel::import(new UploadedEstimateImport, $request->file("estimate_import"));
        }
        else
        {
            $estimatedelete = DB::table('uploadedestimates')
            ->select('*')
            ->where('clientid','=',$clientid)
            ->where('engid','=',$engid)
            ->delete();

            if($estimatedelete)
            {
                $import = Excel::import(new UploadedEstimateImport, $request->file("estimate_import"));
            }
        }


        // dd($estid);
       if($import)
       {
            $getuploadedestimate1 = DB::table('uploadedestimates')
                ->select('*')
                ->where('clientid','=',$clientid)
                ->where('engid','=',$engid)
                ->groupBy("stageid")
                ->get();

                foreach($getuploadedestimate1 as $uploadest)
                {
                    DB::table('twoestimates')
                ->insert([
                    "estid"=>$estid,
                    "clientid"=>$clientid,
                    "engineerid"=>$engid,
                    "stage_num"=>$uploadest->stageid,
                    "stage_title"=>$uploadest->stagename,
                    "descriptionofworks"=>$uploadest->clientdescription
                ]);
                }
            $getuploadedestimate = DB::table('uploadedestimates')
            ->select('*')
            ->where('clientid','=',$clientid)
            ->where('engid','=',$engid)
            ->get();
            // dd($getuploadedestimate);
            foreach($getuploadedestimate as $estimate)
            {


                DB::table('stages')
                ->insert([
                    "estid"=>$estid,
                    "qty"=>$estimate->quantity,
                    "unit"=>$estimate->unit,
                    "descriptions"=>$estimate->descriptions,
                    "rate"=>$estimate->rate,
                    // "per"=>$estimate->per,
                    "amt"=>$estimate->amount,
                    "stage_num"=>$estimate->stageid,
                    // "rentation_amt"=>$estimate->rentention_amount,
                    // "balance_amt"=>$estimate->stagename,
                    "stagetotamt"=>$estimate->stagetotamt,
                    "clientpercentage"=>$estimate->clientpercentage,
                    "clientestimateamt"=>$estimate->clientestimateamt,
                    "paymentsplit"=>$estimate->paymentsplit,
                    "dueamount"=>$estimate->dueamount,
                    "clientestimatedesc"=>$estimate->clientdescription,
                ]);
            }

            $updatestatus = DB::table('estimaterequests')
            ->select('*')
            ->where('clientid','=',$clientid)
            ->where('engineerid','=',$engid)
            ->update([
                "admin_status"=>1,
                "estimate_id"=>$estid
            ]);
       }
    }
}
