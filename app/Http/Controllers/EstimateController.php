<?php

namespace App\Http\Controllers;

use App\Models\Stage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class EstimateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estimates = DB::table('estimates')
        ->select('*')
        ->get();

        $userid = Auth::user()->userid;
        // dd($userid);
        $usrviewestimates = DB::table('estimates')
        ->select('*')
        ->where('clientcode','=',$userid)
        ->first();
        // dd($usrviewestimates);

        if($userid == '3')
        {
            $estimaterequest = DB::Table('estimaterequests')
        ->select('*')
        ->where('engineerid','=',$userid)
        ->get();
        }
        elseif($userid != 4 )
        {
            $estimaterequest = DB::Table('estimaterequests')
        ->select('*')
        ->get();

        }

        // return view('pages.estimates2',compact('estimates','userid','usrviewestimates','estimaterequest'));
        return view('pages.estimates',compact('estimates','userid','usrviewestimates','estimaterequest'));
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


    public function createestimate(Request $request)
    {
        $estid = $request->estid;
        $engineercode = $request->engid;
        $clientcode = $request->clientid;
        $clientname = $request->clientname;
        $stage1title = $request->stage1title;
        $stage2title = $request->stage2title;
        $stage3title = $request->stage3title;
        $stage4title = $request->stage4title;
        $stage5title = $request->stage5title;
        $stage6title = $request->stage6title;
        $stage7title = $request->stage7title;
        $stage8title = $request->stage8title;
        $stage9title = $request->stage9title;
        $stage10title = $request->stage10title;

        $savegeneraldata = DB::table('estimates')
        ->insert([
            "eng_code" => $engineercode,
            "estid" => $estid,
            "clientcode" => $clientcode,
            "clientname" => $clientname,
            "stageonetitle" => $stage1title,
            "stagetwotitle" => $stage2title,
            "stagethreetitle" => $stage3title,
            "stagefourtitle" => $stage4title,
            "stagefivetitle" => $stage5title,
            "stagesixtitle" => $stage6title,
            "stageseventitle" => $stage7title,
            "stageeighttitle" => $stage8title,
            "stageninetitle" => $stage9title,
            "stageeentitle" => $stage10title,
        ]);

        // Stage 1

        $stageoneqty = $request->stageoneqty;

        if($stageoneqty != '')
        {
            foreach($stageoneqty as $key => $stageoneqty)
            {
                $stage1qty = $request->stageoneqty[$key];
                $stage1unit = $request->stageoneunit[$key];
                $stage1desc = $request->stageonedesc[$key];
                $stage1rate = $request->stageonerate[$key];
                $stage1per = $request->stageoneper[$key];
                $stage1amt = $request->stageoneamt[$key];

                DB::table('stages')
                ->insert([
                    "estid"=>$estid,
                    "qty"=>$stage1qty,
                    "unit"=>$stage1unit,
                    "descriptions"=>$stage1desc,
                    "rate"=>$stage1rate,
                    "per"=>$stage1per,
                    "amt"=>$stage1amt,
                    "rentation_amt"=>$stage1amt/100*5,
                    "balance_amt"=>$stage1amt-$stage1amt/100*5,
                    "stage_num"=>1,
                ]);
            }
        }



        $stagetwoqty = $request->stagetwoqty;

        if($stagetwoqty != '')
        {
            foreach($stagetwoqty as $key => $stagetwoqty)
        {
            $stage2qty = $request->stagetwoqty[$key];
            $stage2unit = $request->stagetwounit[$key];
            $stage2desc = $request->stagetwodesc[$key];
            $stage2rate = $request->stagetworate[$key];
            $stage2per = $request->stagetwoper[$key];
            $stage2amt = $request->stagetwoamt[$key];

            DB::table('stages')
            ->insert([
                "estid"=>$estid,
                "qty"=>$stage2qty,
                "unit"=>$stage2unit,
                "descriptions"=>$stage2desc,
                "rate"=>$stage2rate,
                "per"=>$stage2per,
                "amt"=>$stage2amt,
                "rentation_amt"=>$stage2amt/100*5,
                    "balance_amt"=>$stage2amt-$stage2amt/100*5,
                "stage_num"=>2,
            ]);

        }
        }


        $stagethreeqty = $request->stagethreeqty;

        if($stagethreeqty != '')
        {
            foreach($stagethreeqty as $key => $stagethreeqty)
        {
            $stage3qty = $request->stagethreeqty[$key];
            $stage3unit = $request->stagethreeunit[$key];
            $stage3desc = $request->stagethreedesc[$key];
            $stage3rate = $request->stagethreerate[$key];
            $stage3per = $request->stagethreeper[$key];
            $stage3amt = $request->stagethreeamt[$key];

            DB::table('stages')
            ->insert([
                "estid"=>$estid,
                "qty"=>$stage3qty,
                "unit"=>$stage3unit,
                "descriptions"=>$stage3desc,
                "rate"=>$stage3rate,
                "per"=>$stage3per,
                "amt"=>$stage3amt,
                "rentation_amt"=>$stage3amt/100*5,
                    "balance_amt"=>$stage3amt-$stage3amt/100*5,
                "stage_num"=>3,
            ]);

        }
        }



        $stagefourqty = $request->stagefourqty;

        if($stagefourqty != '')
        {
            foreach($stagefourqty as $key => $stagefourqty)
        {
            $stage4qty = $request->stagefourqty[$key];
            $stage4unit = $request->stagefourunit[$key];
            $stage4desc = $request->stagefourdesc[$key];
            $stage4rate = $request->stagefourrate[$key];
            $stage4per = $request->stagefourper[$key];
            $stage4amt = $request->stagefouramt[$key];

            DB::table('stages')
            ->insert([
                "estid"=>$estid,
                "qty"=>$stage4qty,
                "unit"=>$stage4unit,
                "descriptions"=>$stage4desc,
                "rate"=>$stage4rate,
                "per"=>$stage4per,
                "amt"=>$stage4amt,
                "rentation_amt"=>$stage4amt/100*5,
                    "balance_amt"=>$stage4amt-$stage4amt/100*5,
                "stage_num"=>4,
            ]);

        }
        }


        $stagefiveqty = $request->stagefiveqty;

        if($stagefiveqty != '')
        {
            foreach($stagefiveqty as $key => $stagefiveqty)
        {
            $stage5qty = $request->stagefiveqty[$key];
            $stage5unit = $request->stagefiveunit[$key];
            $stage5desc = $request->stagefivedesc[$key];
            $stage5rate = $request->stagefiverate[$key];
            $stage5per = $request->stagefiveper[$key];
            $stage5amt = $request->stagefiveamt[$key];

            DB::table('stages')
            ->insert([
                "estid"=>$estid,
                "qty"=>$stage5qty,
                "unit"=>$stage5unit,
                "descriptions"=>$stage5desc,
                "rate"=>$stage5rate,
                "per"=>$stage5per,
                "amt"=>$stage5amt,
                "rentation_amt"=>$stage5amt/100*5,
                    "balance_amt"=>$stage5amt-$stage5amt/100*5,
                "stage_num"=>5,
            ]);

        }
        }



        $stagesixqty = $request->stagesixqty;

        if($stagesixqty != '')
        {
            foreach($stagesixqty as $key => $stagesixqty)
            {
                $stage6qty = $request->stagesixqty[$key];
                $stage6unit = $request->stagesixunit[$key];
                $stage6desc = $request->stagesixdesc[$key];
                $stage6rate = $request->stagesixrate[$key];
                $stage6per = $request->stagesixper[$key];
                $stage6amt = $request->stagesixamt[$key];

                DB::table('stages')
                ->insert([
                    "estid"=>$estid,
                    "qty"=>$stage6qty,
                    "unit"=>$stage6unit,
                    "descriptions"=>$stage6desc,
                    "rate"=>$stage6rate,
                    "per"=>$stage6per,
                    "amt"=>$stage6amt,
                    "rentation_amt"=>$stage6amt/100*5,
                    "balance_amt"=>$stage6amt-$stage6amt/100*5,
                    "stage_num"=>6,
                ]);

            }
        }


        $stagesevenqty = $request->stagesevenqty;

        if($stagesevenqty != '')
        {
            foreach($stagesevenqty as $key => $stagesevenqty)
        {
            $stage7qty = $request->stagesevenqty[$key];
            $stage7unit = $request->stagesevenunit[$key];
            $stage7desc = $request->stagesevendesc[$key];
            $stage7rate = $request->stagesevenrate[$key];
            $stage7per = $request->stagesevenper[$key];
            $stage7amt = $request->stagesevenamt[$key];

            DB::table('stages')
            ->insert([
                "estid"=>$estid,
                "qty"=>$stage7qty,
                "unit"=>$stage7unit,
                "descriptions"=>$stage7desc,
                "rate"=>$stage7rate,
                "per"=>$stage7per,
                "amt"=>$stage7amt,
                "rentation_amt"=>$stage7amt/100*5,
                    "balance_amt"=>$stage7amt-$stage7amt/100*5,
                "stage_num"=>7,
            ]);

        }
        }


        $stageeightqty = $request->stageeightqty;

        if($stageeightqty != '')
        {
            foreach($stageeightqty as $key => $stageeightqty)
        {
            $stage8qty = $request->stageeightqty[$key];
            $stage8unit = $request->stageeightunit[$key];
            $stage8desc = $request->stageeightdesc[$key];
            $stage8rate = $request->stageeightrate[$key];
            $stage8per = $request->stageeightper[$key];
            $stage8amt = $request->stageeightamt[$key];

            DB::table('stages')
            ->insert([
                "estid"=>$estid,
                "qty"=>$stage8qty,
                "unit"=>$stage8unit,
                "descriptions"=>$stage8desc,
                "rate"=>$stage8rate,
                "per"=>$stage8per,
                "amt"=>$stage8amt,
                "rentation_amt"=>$stage8amt/100*5,
                    "balance_amt"=>$stage8amt-$stage8amt/100*5,
                "stage_num"=>8,
            ]);

        }
        }


        $stagenineqty = $request->stagenineqty;

        if($stagenineqty != '')
        {
            foreach($stagenineqty as $key => $stagenineqty)
        {
            $stage9qty = $request->stagenineqty[$key];
            $stage9unit = $request->stagenineunit[$key];
            $stage9desc = $request->stageninedesc[$key];
            $stage9rate = $request->stageninerate[$key];
            $stage9per = $request->stagenineper[$key];
            $stage9amt = $request->stagenineamt[$key];

            DB::table('stages')
            ->insert([
                "estid"=>$estid,
                "qty"=>$stage9qty,
                "unit"=>$stage9unit,
                "descriptions"=>$stage9desc,
                "rate"=>$stage9rate,
                "per"=>$stage9per,
                "amt"=>$stage9amt,
                "rentation_amt"=>$stage9amt/100*5,
                    "balance_amt"=>$stage9amt-$stage9amt/100*5,
                "stage_num"=>9,
            ]);

        }
        }


        $stagetenqty = $request->stagetenqty;

        if($stagetenqty != '')
        {
            foreach($stagetenqty as $key => $stagetenqty)
            {
                $stage10qty = $request->stagetenqty[$key];
                $stage10unit = $request->stagetenunit[$key];
                $stage10desc = $request->stagetendesc[$key];
                $stage10rate = $request->stagetenrate[$key];
                $stage10per = $request->stagetenper[$key];
                $stage10amt = $request->stagetenamt[$key];

                DB::table('stages')
                ->insert([
                    "estid"=>$estid,
                    "qty"=>$stage10qty,
                    "unit"=>$stage10unit,
                    "descriptions"=>$stage10desc,
                    "rate"=>$stage10rate,
                    "per"=>$stage10per,
                    "amt"=>$stage10amt,
                    "rentation_amt"=>$stage10amt/100*5,
                    "balance_amt"=>$stage10amt-$stage10amt/100*5,
                    "stage_num"=>10,
                ]);

            }
        }

        $updatestatus = DB::table('estimaterequests')
        ->select('*')
        ->where('clientid','=',$clientcode)
        ->where('engineerid','=',$engineercode)
        ->update([
            "admin_status"=>1,
            "estimate_id"=>$estid
        ]);

        DB::table('stages')
        ->select('*')
        ->where('qty','=',null)
        ->delete();
        // return $savegeneraldata;
    }


    public function deleteest($id)
    {
        $delete = DB::table('estimates')
        ->select('*')
        ->where('estid','=',$id)
        ->delete();


    }

    public function getestimate($engid,$clientid){

        $stages = DB::table('twoestimates')
        ->select('*')
        ->where("engineerid",'=',$engid)
        ->where("clientid",'=',$clientid)
        ->groupBy('stage_num')
        ->get();

        $stagesfirst = DB::table('twoestimates')
        ->select('*')
        ->where("engineerid",'=',$engid)
        ->where("clientid",'=',$clientid)
        ->first();

        $totamt = DB::table('stages')
        ->select('*')
        ->where("estid",'=',$stagesfirst->estid)
        ->sum('amt');

        return view('pages.estimatedetails',compact('stages','totamt','clientid'));
    }


    public function overallestimate($estid)
    {
        $getestimate = DB::table('estimates')
        ->select("*")
        ->where("estid",'=',$estid)
        ->first();

        $estimatetotamt = Stage::where('estid', $estid)
        ->sum('amt');

        $stageoneamt = Stage::where('estid', $estid)
        ->where('stage_num','1')
        ->sum('amt');

        $stagetwoamt = Stage::where('estid', $estid)
        ->where('stage_num','2')
        ->sum('amt');

        $stagethreeamt = Stage::where('estid', $estid)
        ->where('stage_num','3')
        ->sum('amt');

        $stagefouramt = Stage::where('estid', $estid)
        ->where('stage_num','4')
        ->sum('amt');

        $stagefiveamt = Stage::where('estid', $estid)
        ->where('stage_num','5')
        ->sum('amt');

        $stagesixamt = Stage::where('estid', $estid)
        ->where('stage_num','6')
        ->sum('amt');

        $stagesevenamt = Stage::where('estid', $estid)
        ->where('stage_num','7')
        ->sum('amt');

        $stageeightamt = Stage::where('estid', $estid)
        ->where('stage_num','8')
        ->sum('amt');

        $stagenineamt = Stage::where('estid', $estid)
        ->where('stage_num','9')
        ->sum('amt');

        $stagetenamt = Stage::where('estid', $estid)
        ->where('stage_num','10')
        ->sum('amt');

        // $estimateidid = $getestimate->estid;

        // dd($getestimate);
        return view('pages.ovrlestimate',compact('getestimate','stageoneamt','stagetwoamt','stagethreeamt','stagefouramt','stagefiveamt','stagesixamt','stagesevenamt','stageeightamt','stagenineamt','stagetenamt','estimatetotamt'));
    }

    public function stageone($estid)
    {
        $getestimate = DB::table('estimates')
        ->select("*")
        ->where("estid",'=',$estid)
        ->first();

        $estimatetotamt = Stage::where('estid', $estid)
        ->sum('amt');

        $stageoneamt = Stage::where('estid', $estid)
        ->where('stage_num','1')
        ->sum('amt');

        $stagetwoamt = Stage::where('estid', $estid)
        ->where('stage_num','2')
        ->sum('amt');

        $stagethreeamt = Stage::where('estid', $estid)
        ->where('stage_num','3')
        ->sum('amt');

        $stagefouramt = Stage::where('estid', $estid)
        ->where('stage_num','4')
        ->sum('amt');

        $stagefiveamt = Stage::where('estid', $estid)
        ->where('stage_num','5')
        ->sum('amt');

        $stagesixamt = Stage::where('estid', $estid)
        ->where('stage_num','6')
        ->sum('amt');

        $stagesevenamt = Stage::where('estid', $estid)
        ->where('stage_num','7')
        ->sum('amt');

        $stageeightamt = Stage::where('estid', $estid)
        ->where('stage_num','8')
        ->sum('amt');

        $stagenineamt = Stage::where('estid', $estid)
        ->where('stage_num','9')
        ->sum('amt');

        $stagetenamt = Stage::where('estid', $estid)
        ->where('stage_num','10')
        ->sum('amt');

        // $estimateidid = $getestimate->estid;

        // dd($getestimate);
        return view('pages.stageoneestimate',compact('getestimate','stageoneamt','stagetwoamt','stagethreeamt','stagefouramt','stagefiveamt','stagesixamt','stagesevenamt','stageeightamt','stagenineamt','stagetenamt','estimatetotamt'));
    }

    public function stagetwo($estid)
    {
        $getestimate = DB::table('estimates')
        ->select("*")
        ->where("estid",'=',$estid)
        ->first();

        $estimatetotamt = Stage::where('estid', $estid)
        ->sum('amt');

        $stageoneamt = Stage::where('estid', $estid)
        ->where('stage_num','1')
        ->sum('amt');

        $stagetwoamt = Stage::where('estid', $estid)
        ->where('stage_num','2')
        ->sum('amt');

        $stagethreeamt = Stage::where('estid', $estid)
        ->where('stage_num','3')
        ->sum('amt');

        $stagefouramt = Stage::where('estid', $estid)
        ->where('stage_num','4')
        ->sum('amt');

        $stagefiveamt = Stage::where('estid', $estid)
        ->where('stage_num','5')
        ->sum('amt');

        $stagesixamt = Stage::where('estid', $estid)
        ->where('stage_num','6')
        ->sum('amt');

        $stagesevenamt = Stage::where('estid', $estid)
        ->where('stage_num','7')
        ->sum('amt');

        $stageeightamt = Stage::where('estid', $estid)
        ->where('stage_num','8')
        ->sum('amt');

        $stagenineamt = Stage::where('estid', $estid)
        ->where('stage_num','9')
        ->sum('amt');

        $stagetenamt = Stage::where('estid', $estid)
        ->where('stage_num','10')
        ->sum('amt');

        // $estimateidid = $getestimate->estid;

        // dd($getestimate);
        return view('pages.stagetwoestimate',compact('getestimate','stageoneamt','stagetwoamt','stagethreeamt','stagefouramt','stagefiveamt','stagesixamt','stagesevenamt','stageeightamt','stagenineamt','stagetenamt','estimatetotamt'));
    }

    public function stagethree($estid)
    {
        $getestimate = DB::table('estimates')
        ->select("*")
        ->where("estid",'=',$estid)
        ->first();

        $estimatetotamt = Stage::where('estid', $estid)
        ->sum('amt');

        $stageoneamt = Stage::where('estid', $estid)
        ->where('stage_num','1')
        ->sum('amt');

        $stagetwoamt = Stage::where('estid', $estid)
        ->where('stage_num','2')
        ->sum('amt');

        $stagethreeamt = Stage::where('estid', $estid)
        ->where('stage_num','3')
        ->sum('amt');

        $stagefouramt = Stage::where('estid', $estid)
        ->where('stage_num','4')
        ->sum('amt');

        $stagefiveamt = Stage::where('estid', $estid)
        ->where('stage_num','5')
        ->sum('amt');

        $stagesixamt = Stage::where('estid', $estid)
        ->where('stage_num','6')
        ->sum('amt');

        $stagesevenamt = Stage::where('estid', $estid)
        ->where('stage_num','7')
        ->sum('amt');

        $stageeightamt = Stage::where('estid', $estid)
        ->where('stage_num','8')
        ->sum('amt');

        $stagenineamt = Stage::where('estid', $estid)
        ->where('stage_num','9')
        ->sum('amt');

        $stagetenamt = Stage::where('estid', $estid)
        ->where('stage_num','10')
        ->sum('amt');

        // $estimateidid = $getestimate->estid;

        // dd($getestimate);
        return view('pages.stagethreeestimate',compact('getestimate','stageoneamt','stagetwoamt','stagethreeamt','stagefouramt','stagefiveamt','stagesixamt','stagesevenamt','stageeightamt','stagenineamt','stagetenamt','estimatetotamt'));
    }

    public function stagefour($estid)
    {
        $getestimate = DB::table('estimates')
        ->select("*")
        ->where("estid",'=',$estid)
        ->first();

        $estimatetotamt = Stage::where('estid', $estid)
        ->sum('amt');

        $stageoneamt = Stage::where('estid', $estid)
        ->where('stage_num','1')
        ->sum('amt');

        $stagetwoamt = Stage::where('estid', $estid)
        ->where('stage_num','2')
        ->sum('amt');

        $stagethreeamt = Stage::where('estid', $estid)
        ->where('stage_num','3')
        ->sum('amt');

        $stagefouramt = Stage::where('estid', $estid)
        ->where('stage_num','4')
        ->sum('amt');

        $stagefiveamt = Stage::where('estid', $estid)
        ->where('stage_num','5')
        ->sum('amt');

        $stagesixamt = Stage::where('estid', $estid)
        ->where('stage_num','6')
        ->sum('amt');

        $stagesevenamt = Stage::where('estid', $estid)
        ->where('stage_num','7')
        ->sum('amt');

        $stageeightamt = Stage::where('estid', $estid)
        ->where('stage_num','8')
        ->sum('amt');

        $stagenineamt = Stage::where('estid', $estid)
        ->where('stage_num','9')
        ->sum('amt');

        $stagetenamt = Stage::where('estid', $estid)
        ->where('stage_num','10')
        ->sum('amt');

        // $estimateidid = $getestimate->estid;

        // dd($getestimate);
        return view('pages.stagefourestimate',compact('getestimate','stageoneamt','stagetwoamt','stagethreeamt','stagefouramt','stagefiveamt','stagesixamt','stagesevenamt','stageeightamt','stagenineamt','stagetenamt','estimatetotamt'));
    }

    public function stagefive($estid)
    {
        $getestimate = DB::table('estimates')
        ->select("*")
        ->where("estid",'=',$estid)
        ->first();

        $estimatetotamt = Stage::where('estid', $estid)
        ->sum('amt');

        $stageoneamt = Stage::where('estid', $estid)
        ->where('stage_num','1')
        ->sum('amt');

        $stagetwoamt = Stage::where('estid', $estid)
        ->where('stage_num','2')
        ->sum('amt');

        $stagethreeamt = Stage::where('estid', $estid)
        ->where('stage_num','3')
        ->sum('amt');

        $stagefouramt = Stage::where('estid', $estid)
        ->where('stage_num','4')
        ->sum('amt');

        $stagefiveamt = Stage::where('estid', $estid)
        ->where('stage_num','5')
        ->sum('amt');

        $stagesixamt = Stage::where('estid', $estid)
        ->where('stage_num','6')
        ->sum('amt');

        $stagesevenamt = Stage::where('estid', $estid)
        ->where('stage_num','7')
        ->sum('amt');

        $stageeightamt = Stage::where('estid', $estid)
        ->where('stage_num','8')
        ->sum('amt');

        $stagenineamt = Stage::where('estid', $estid)
        ->where('stage_num','9')
        ->sum('amt');

        $stagetenamt = Stage::where('estid', $estid)
        ->where('stage_num','10')
        ->sum('amt');

        // $estimateidid = $getestimate->estid;

        // dd($getestimate);
        return view('pages.stagefiveestimate',compact('getestimate','stageoneamt','stagetwoamt','stagethreeamt','stagefouramt','stagefiveamt','stagesixamt','stagesevenamt','stageeightamt','stagenineamt','stagetenamt','estimatetotamt'));
    }

    public function stagesix($estid)
    {
        $getestimate = DB::table('estimates')
        ->select("*")
        ->where("estid",'=',$estid)
        ->first();

        $estimatetotamt = Stage::where('estid', $estid)
        ->sum('amt');

        $stageoneamt = Stage::where('estid', $estid)
        ->where('stage_num','1')
        ->sum('amt');

        $stagetwoamt = Stage::where('estid', $estid)
        ->where('stage_num','2')
        ->sum('amt');

        $stagethreeamt = Stage::where('estid', $estid)
        ->where('stage_num','3')
        ->sum('amt');

        $stagefouramt = Stage::where('estid', $estid)
        ->where('stage_num','4')
        ->sum('amt');

        $stagefiveamt = Stage::where('estid', $estid)
        ->where('stage_num','5')
        ->sum('amt');

        $stagesixamt = Stage::where('estid', $estid)
        ->where('stage_num','6')
        ->sum('amt');

        $stagesevenamt = Stage::where('estid', $estid)
        ->where('stage_num','7')
        ->sum('amt');

        $stageeightamt = Stage::where('estid', $estid)
        ->where('stage_num','8')
        ->sum('amt');

        $stagenineamt = Stage::where('estid', $estid)
        ->where('stage_num','9')
        ->sum('amt');

        $stagetenamt = Stage::where('estid', $estid)
        ->where('stage_num','10')
        ->sum('amt');

        // $estimateidid = $getestimate->estid;

        // dd($getestimate);
        return view('pages.stagesixestimate',compact('getestimate','stageoneamt','stagetwoamt','stagethreeamt','stagefouramt','stagefiveamt','stagesixamt','stagesevenamt','stageeightamt','stagenineamt','stagetenamt','estimatetotamt'));
    }

    public function stageseven($estid)
    {
        $getestimate = DB::table('estimates')
        ->select("*")
        ->where("estid",'=',$estid)
        ->first();

        $estimatetotamt = Stage::where('estid', $estid)
        ->sum('amt');

        $stageoneamt = Stage::where('estid', $estid)
        ->where('stage_num','1')
        ->sum('amt');

        $stagetwoamt = Stage::where('estid', $estid)
        ->where('stage_num','2')
        ->sum('amt');

        $stagethreeamt = Stage::where('estid', $estid)
        ->where('stage_num','3')
        ->sum('amt');

        $stagefouramt = Stage::where('estid', $estid)
        ->where('stage_num','4')
        ->sum('amt');

        $stagefiveamt = Stage::where('estid', $estid)
        ->where('stage_num','5')
        ->sum('amt');

        $stagesixamt = Stage::where('estid', $estid)
        ->where('stage_num','6')
        ->sum('amt');

        $stagesevenamt = Stage::where('estid', $estid)
        ->where('stage_num','7')
        ->sum('amt');

        $stageeightamt = Stage::where('estid', $estid)
        ->where('stage_num','8')
        ->sum('amt');

        $stagenineamt = Stage::where('estid', $estid)
        ->where('stage_num','9')
        ->sum('amt');

        $stagetenamt = Stage::where('estid', $estid)
        ->where('stage_num','10')
        ->sum('amt');

        // $estimateidid = $getestimate->estid;

        // dd($getestimate);
        return view('pages.stagesevenestimate',compact('getestimate','stageoneamt','stagetwoamt','stagethreeamt','stagefouramt','stagefiveamt','stagesixamt','stagesevenamt','stageeightamt','stagenineamt','stagetenamt','estimatetotamt'));
    }

    public function stageeight($estid)
    {
        $getestimate = DB::table('estimates')
        ->select("*")
        ->where("estid",'=',$estid)
        ->first();

        $estimatetotamt = Stage::where('estid', $estid)
        ->sum('amt');

        $stageoneamt = Stage::where('estid', $estid)
        ->where('stage_num','1')
        ->sum('amt');

        $stagetwoamt = Stage::where('estid', $estid)
        ->where('stage_num','2')
        ->sum('amt');

        $stagethreeamt = Stage::where('estid', $estid)
        ->where('stage_num','3')
        ->sum('amt');

        $stagefouramt = Stage::where('estid', $estid)
        ->where('stage_num','4')
        ->sum('amt');

        $stagefiveamt = Stage::where('estid', $estid)
        ->where('stage_num','5')
        ->sum('amt');

        $stagesixamt = Stage::where('estid', $estid)
        ->where('stage_num','6')
        ->sum('amt');

        $stagesevenamt = Stage::where('estid', $estid)
        ->where('stage_num','7')
        ->sum('amt');

        $stageeightamt = Stage::where('estid', $estid)
        ->where('stage_num','8')
        ->sum('amt');

        $stagenineamt = Stage::where('estid', $estid)
        ->where('stage_num','9')
        ->sum('amt');

        $stagetenamt = Stage::where('estid', $estid)
        ->where('stage_num','10')
        ->sum('amt');

        // $estimateidid = $getestimate->estid;

        // dd($getestimate);
        return view('pages.stageeightestimate',compact('getestimate','stageoneamt','stagetwoamt','stagethreeamt','stagefouramt','stagefiveamt','stagesixamt','stagesevenamt','stageeightamt','stagenineamt','stagetenamt','estimatetotamt'));
    }

    public function stagenine($estid)
    {
        $getestimate = DB::table('estimates')
        ->select("*")
        ->where("estid",'=',$estid)
        ->first();

        $estimatetotamt = Stage::where('estid', $estid)
        ->sum('amt');

        $stageoneamt = Stage::where('estid', $estid)
        ->where('stage_num','1')
        ->sum('amt');

        $stagetwoamt = Stage::where('estid', $estid)
        ->where('stage_num','2')
        ->sum('amt');

        $stagethreeamt = Stage::where('estid', $estid)
        ->where('stage_num','3')
        ->sum('amt');

        $stagefouramt = Stage::where('estid', $estid)
        ->where('stage_num','4')
        ->sum('amt');

        $stagefiveamt = Stage::where('estid', $estid)
        ->where('stage_num','5')
        ->sum('amt');

        $stagesixamt = Stage::where('estid', $estid)
        ->where('stage_num','6')
        ->sum('amt');

        $stagesevenamt = Stage::where('estid', $estid)
        ->where('stage_num','7')
        ->sum('amt');

        $stageeightamt = Stage::where('estid', $estid)
        ->where('stage_num','8')
        ->sum('amt');

        $stagenineamt = Stage::where('estid', $estid)
        ->where('stage_num','9')
        ->sum('amt');

        $stagetenamt = Stage::where('estid', $estid)
        ->where('stage_num','10')
        ->sum('amt');

        // $estimateidid = $getestimate->estid;

        // dd($getestimate);
        return view('pages.stagenineestimate',compact('getestimate','stageoneamt','stagetwoamt','stagethreeamt','stagefouramt','stagefiveamt','stagesixamt','stagesevenamt','stageeightamt','stagenineamt','stagetenamt','estimatetotamt'));
    }

    public function stageten($estid)
    {
        $getestimate = DB::table('estimates')
        ->select("*")
        ->where("estid",'=',$estid)
        ->first();

        $estimatetotamt = Stage::where('estid', $estid)
        ->sum('amt');

        $stageoneamt = Stage::where('estid', $estid)
        ->where('stage_num','1')
        ->sum('amt');

        $stagetwoamt = Stage::where('estid', $estid)
        ->where('stage_num','2')
        ->sum('amt');

        $stagethreeamt = Stage::where('estid', $estid)
        ->where('stage_num','3')
        ->sum('amt');

        $stagefouramt = Stage::where('estid', $estid)
        ->where('stage_num','4')
        ->sum('amt');

        $stagefiveamt = Stage::where('estid', $estid)
        ->where('stage_num','5')
        ->sum('amt');

        $stagesixamt = Stage::where('estid', $estid)
        ->where('stage_num','6')
        ->sum('amt');

        $stagesevenamt = Stage::where('estid', $estid)
        ->where('stage_num','7')
        ->sum('amt');

        $stageeightamt = Stage::where('estid', $estid)
        ->where('stage_num','8')
        ->sum('amt');

        $stagenineamt = Stage::where('estid', $estid)
        ->where('stage_num','9')
        ->sum('amt');

        $stagetenamt = Stage::where('estid', $estid)
        ->where('stage_num','10')
        ->sum('amt');

        // $estimateidid = $getestimate->estid;

        // dd($getestimate);
        return view('pages.stagetenestimate',compact('getestimate','stageoneamt','stagetwoamt','stagethreeamt','stagefouramt','stagefiveamt','stagesixamt','stagesevenamt','stageeightamt','stagenineamt','stagetenamt','estimatetotamt'));
    }

    public function stagepaid($id)
    {
        $payment = DB::table('stages')
        ->select('*')
        ->where('id','=',$id)
        ->update([
            'payment_status'=>1,
            'approval_status'=>1
        ]);

        return $payment;

    }

    public function estimaterequest(Request $request)
    {
        $clientcode = $request->clientcode;
        $engineercode = $request->engineercode;
        $leadid = $request->leadid;

        $saverequest = DB::table('estimaterequests')
        ->insert([
            "clientid"=>$clientcode,
            "engineerid"=>$engineercode,
            "leadid"=>$leadid
        ]);

        return $saverequest;
    }

    public function createmainest($engid,$clientid)
    {
        $stagemasters = DB::table('stagemasters')
        ->select('*')
        ->groupBy('stageid')
        ->get();

        $estid = DB::table('twoestimates')
        ->select('*')
        ->where('clientid','=',$clientid)
        ->where('engineerid','=',$engid)
        ->first();

        // dd($estid);

        if($estid == null)
        {
            $invID =0;
            $maxValue = DB::table('twoestimates')->groupBy('estid')->get()->count();
            // dd($maxValue);
            $invID=$maxValue+1;
            $invID = str_pad($invID, 3, '0', STR_PAD_LEFT);
            $estid="EST".$invID;
        }
        else
        {
            $estid = $estid->estid;
        }

        return view('pages.createmainest',compact('engid','clientid','stagemasters','estid'));
    }

    public function createMainestimate(Request $request)
    {
        $clientid = $request->clientid;
        $engid = $request->engid;
        // $projectvalue = $request->projectvalue;

        $stage = $request->stage;
        $stageamt = $request->stageamt;
        $stagepercentage = $request->stagepercentage;

        foreach($stage as $key => $stage)
        {
            $stage = $request->stage[$key];
            $stageamt = $request->stageamt[$key];
            $stagepercentage = $request->stagepercentage[$key];

            $mainest = DB::table('mainestimates')
            ->insert([
                "clientid"=>$clientid,
                "engid"=>$engid,
                // "projectvalue"=>$projectvalue,
                "stages"=>$stage,
                "amount"=>$stageamt,
                "percentageofwork"=>$stagepercentage,

            ]);

        }

        return $mainest;

    }


    public function addTempestimate(Request $request)
    {
        $engid = $request->engid;
        $clientid = $request->clientid;
        $estimateid = "TEMP_".$request->estimateid;

        $duplicate = DB::table('temptwoestimates')
        ->select('*')
        ->where("estid",'=',$estimateid)
        ->get();

        if($duplicate->count() == '0')
        {
            $stages = $request->stages;

        foreach($stages as $key => $st)
        {
            $stage = $request->stages[$key];

            $stagename = DB::table('stagemasters')
            ->select('*')
            ->where('stageid','=',$stage)
            ->first();



            if($duplicate)
            {
                DB::table('temptwoestimates')
                ->insert([
                    "estid" => $estimateid,
                    "clientid" => $clientid,
                    "engineerid" => $engid,
                    "stage_num" => $stage,
                    "stage_title" => $stagename->stagename,
                    "status" => 0
                ]);
            }

        }
        }


        return view('pages.makeestimate',compact('estimateid','clientid','engid'));
    }


    public function saveestimate(Request $request)
    {
        $engid = $request->engid;
        $clientid = $request->clientid;
        $estimateid = $request->estimateid;


        $stageqty = $request->stageqty;

        if($stageqty != '')
        {
            foreach($stageqty as $key => $stageqty)
            {
                $stageqty = $request->stageqty[$key];
                $stageunit = $request->stageunit[$key];
                $stagedesc = $request->stagedesc[$key];
                $stagerate = $request->stagerate[$key];
                // $stageper = $request->stageper[$key];
                $stageamt = $request->stageamt[$key];
                $stagenum = $request->stagenum[$key];


                DB::table('tempstages')
                ->insert([
                    "estid"=>$estimateid,
                    "qty"=>$stageqty,
                    "unit"=>$stageunit,
                    "descriptions"=>$stagedesc,
                    "rate"=>$stagerate,
                    // "per"=>$stageper,
                    "amt"=>$stageamt,
                    "rentation_amt"=>$stageamt/100*5,
                    "balance_amt"=>$stageamt-$stageamt/100*5,
                    "stage_num"=> $stagenum,
                    // "stagetotamt"=>$stagetotamt,
                    // "clientpercentage"=>$clientpercentage,
                    // "clientestimateamt"=>$clientestimateamt,
                    // "paymentsplit"=>$paymentsplit,
                    // "dueamount"=>$dueamount,
                ]);

            }

            $calcstage = $request->calcstage;

                foreach($calcstage as $key => $stage)
                {
                    $stage = $request->calcstage[$key];

                        $stagetotamt = $request->stagetotamt[$key];
                        $clientpercentage = $request->clientpercentage[$key];
                        $clientestimateamt = $request->clientestimateamt[$key];
                        $paymentsplit = $request->paymentsplit[$key];
                        $dueamount = $request->dueamount[$key];
                        $clientestimatedesc= $request->clientestimatedesc[$key];

                        DB::table('tempstages')
                        ->where('stage_num','=',$stage)
                        ->where('estid','=',$estimateid)
                        ->update([
                            "stagetotamt"=>$stagetotamt,
                            "clientpercentage"=>$clientpercentage,
                            "clientestimateamt"=>$clientestimateamt,
                            "paymentsplit"=>$paymentsplit,
                            "dueamount"=>$dueamount,
                            "clientestimatedesc"=>$clientestimatedesc
                        ]);

                         DB::table('temptwoestimates')
                        ->select('*')
                        ->where('stage_num','=',$stage)
                        ->where('estid','=',$estimateid)
                        ->update([
                            "descriptionofworks"=>$clientestimatedesc
                        ]);
                }
        }

        $tempest = DB::table('temptwoestimates')
        ->select('*')
        ->where('estid','=',$estimateid)
        ->get();

        $maxValue = DB::table('twoestimates')->groupBy('estid')->get()->count();
        // dd($maxValue);
        $invID=$maxValue+1;
        $invID = str_pad($invID, 3, '0', STR_PAD_LEFT);
        $estid="EST".$invID;

        foreach($tempest as $temp)
        {
            DB::table('twoestimates')
                ->insert([
                    "estid"=>$estid,
                    "clientid"=>$temp->clientid,
                    "engineerid"=>$temp->engineerid,
                    "stage_num"=>$temp->stage_num,
                    "stage_title"=>$temp->stage_title,
                    "descriptionofworks"=>$temp->descriptionofworks
                ]);
        }

        $tempstages = DB::table('tempstages')
        ->select('*')
        ->where('estid','=',$estimateid)
        ->get();

        foreach($tempstages as $stages)
        {
            DB::table('stages')
                ->insert([
                    "estid"=>$estid,
                    "qty"=>$stages->qty,
                    "unit"=>$stages->unit,
                    "descriptions"=>$stages->descriptions,
                    "rate"=>$stages->rate,
                    // "per"=>$estimate->per,
                    "amt"=>$stages->amt,
                    "stage_num"=>$stages->stage_num,
                    "rentation_amt"=>$stages->rentation_amt,
                    "balance_amt"=>$stages->balance_amt,
                    "stagetotamt"=>$stages->stagetotamt,
                    "clientpercentage"=>$stages->clientpercentage,
                    "clientestimateamt"=>$stages->clientestimateamt,
                    "paymentsplit"=>$stages->paymentsplit,
                    "dueamount"=>$stages->dueamount,
                    "clientestimatedesc"=>$stages->clientestimatedesc
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

        DB::table('notifications')
        ->select('*')
        ->insert([
            "notificationview" => $engid,
            "notificationstatus" =>0,
            "purposeid"=>$estid,
            "purposename" => $clientid." Estimate Created Successfully"
        ]);

    }


    public function Editestimate($estid){
        // $get_estimate = DB::table('stages')->get();

        $engid = DB::table("twoestimates")->select("engineerid")->where("estid","=",$estid)->first();

        $clientid = DB::table("twoestimates")->select("clientid")->where("estid","=",$estid)->first();

        $estimateid = DB::table("twoestimates")->select("estid")->where("estid","=",$estid)->first();

        $viewengid = $engid->engineerid;
        $viewclientid = $clientid->clientid;
        $viewestimateid = $estimateid->estid;

        return view("pages.editestimate",compact("viewengid","viewclientid","viewestimateid"));
    }

    public function Updateestimate(Request $request){
        $stageqty = $request->stageqty;
        $estimateid = $request->hidden_estid;

         $delete = DB::table("stages")->where("estid","=",$estimateid)->delete();

         if($delete){
            foreach($stageqty as $key => $stageqty)
            {

                $stageqty = $request->stageqty[$key];
                $stageunit = $request->stageunit[$key];
                $stagedesc = $request->stagedesc[$key];
                $stagerate = $request->stagerate[$key];
                $stageamt = $request->stageamt[$key];
                $stagenum = $request->stagenum[$key];

                DB::table('stages')
                ->insert([
                    "estid"=>$estimateid,
                    "qty"=>$stageqty,
                    "unit"=>$stageunit,
                    "descriptions"=>$stagedesc,
                    "rate"=>$stagerate,
                    "amt"=>$stageamt,
                    "rentation_amt"=>$stageamt/100*5,
                    "balance_amt"=>$stageamt-$stageamt/100*5,
                    "stage_num"=> $stagenum,

                ]);
            }

            $calcstage = $request->calcstage;
            // dd($calcstage);
                foreach($calcstage as $key => $stage)
                {
                    $stage = $request->calcstage[$key];

                        $stagetotamt = $request->stagetotamt[$key];
                        $clientpercentage = $request->clientpercentage[$key];
                        $clientestimateamt = $request->clientestimateamt[$key];
                        $paymentsplit = $request->paymentsplit[$key];
                        $dueamount = $request->dueamount[$key];
                        $clientestimatedesc= $request->clientestimatedesc[$key];

                        DB::table('stages')
                        ->where('stage_num','=',$stage)
                        ->where('estid','=',$estimateid)
                        ->update([
                            "stagetotamt"=>$stagetotamt,
                            "clientpercentage"=>$clientpercentage,
                            "clientestimateamt"=>$clientestimateamt,
                            "paymentsplit"=>$paymentsplit,
                            "dueamount"=>$dueamount,
                            "clientestimatedesc"=>$clientestimatedesc
                        ]);



                }
        }

        return redirect("/estimatereq")->with("Success-Estimate","Updated");

    }


}
