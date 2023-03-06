<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Image;
use Validator;

class DrawingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usertype = Auth::user()->usertype;
        $userid = Auth::user()->userid;
        if($usertype == '3')
        {
            $getclients = DB::table('clients')
            ->select('*')
            ->where('engineercode','=',$userid)
            ->get();
        }
        else
        {
            $getclients = DB::table('clients')
            ->select('*')
            ->get();
        }

        if($usertype == '3')
        {
            $getdrawings = DB::table('drawings')
            ->select('*')
            ->where('engineerid','=',$userid)
            ->get();
        }
        elseif($usertype == '4')
        {
            $getdrawings = DB::table('drawings')
            ->select('*')
            ->where('clientid','=',$userid)
            ->get();
        }
        elseif($usertype == '5')
        {
            $getdrawings = DB::table('drawings')
            ->select('*')
            ->where('assigned_to','=',$userid)
            ->get();
        }
        elseif($usertype == '20')
        {
            $getdrawings = DB::table('drawings')
            ->select('*')
            ->where('assign_to_strceng','=',$userid)
            ->get();
        }
        else
        {
            $getdrawings = DB::table('drawings')
            ->select('*')
            ->get();
        }

        if($usertype == '14')
        {
            $getartect = DB::table('users')
            ->select('*')
            ->whereIn('role',[5,14])
            ->get();
        }
        else
        {
            $getartect = '';
        }

        if($usertype == '18')
        {
            $getstructuraleng = DB::table('users')
        ->select('*')
        ->whereIn('role',[20,18])
        ->get();
        }
        else
        {
            $getstructuraleng = '';

        }





        return view('pages.drawings',compact('getclients','getdrawings','getstructuraleng','getartect'));
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

    public function drawrequest(Request $request)
    {
        $validated = Validator::make($request->all(),[
            // 'clientid' => 'required',
            'engineerid' => 'required',
        ]);

        $clientid = $request->clientid;
        $engineerid = $request->engineerid;
        // $drawimage = $request->drawimage;
        $packagetype = $request->package;
        $leadid = $request->leadid;

        $invID =0;
         $maxValue = DB::table('drawings')->max('id');
         $invID=$maxValue+1;
         $invID = str_pad($invID, 3, '0', STR_PAD_LEFT);
         $drawid="BB-DRAREQ-".$invID;
         if($request->hasfile('drawimage'))
         {
            //  $file = $request->file('drawimage');
            //  $name = $file ->getClientOriginalName();
            //  $extension = $file ->getClientOriginalExtension();
            // //  $filename = time().'_drawimg'.'.'.$extension;
            //  $filename = $name;
            //  $img = Image::make($file->getRealPath());
            //  $img->save(public_path('images/'.$filename));
            //  $drawimage = $filename;

              $file = $request->file('drawimage');
              $name = $file ->getClientOriginalName();
             $extension = $file ->getClientOriginalExtension();
             $filename = $name;
             $file->move('images/',$filename);
             $drawimage = $filename;
         }




         if($validated->passes())
         {
            $drawimage = DB::table('drawings')->insert([
                "clientid"=>$clientid,
                "engineerid"=>$engineerid,
                "drawimage"=>$drawimage,
                "drawid" =>$drawid,
                "packagetype" => $packagetype,
                "leadid" => $leadid
            ]);

            if($drawimage)
            {
                return response()->json(['success'=>'Drawing Created Successfully']);
            }

         }

         return response()->json(['error'=>$validated->errors()]);
    }


    public function replydraw(Request $request)
    {
        $drawid = $request->replydraw;
        // $officesededimage = $request->officesededimage;
        $officesideuser = Auth::user()->userid;
        $officesideupdeddate = date("Y-m-d H:i:s");

        if($request->hasfile('officesededimage'))
         {
             $file = $request->file('officesededimage');
             $extension = $file ->getClientOriginalExtension();
             $filename = time().'_drawimg'.'.'.$extension;
             $file->move('images/',$filename);
             $officesededimage = $filename;
         }

        $updatedraw = DB::table('drawings')
        ->select('*')
        ->where('drawid','=',$drawid)
        ->update([
            "officesededimage"=>$officesededimage,
            "officesideuser"=>$officesideuser,
            "officesideupdeddate"=>$officesideupdeddate,
            "status"=>"1"
        ]);

        $getaename = DB::table('drawings')
        ->select('*')
        ->where('drawid','=',$drawid)
        ->first();

        DB::table('notifications')
            ->insert([
                "notificationview"=>$getaename->engineerid,
                "notificationstatus"=>0,
                "purposeid"=>$drawid,
                "purposename" => "$drawid Architect Upload drawing successfully"
                ]);

        if($updatedraw)
        {
            return response()->json(['success'=>'Drawing Updated Successfully']);
        }
    }

    public function uploaddraw($drawid,$pactype,$leadid)
    {
        if($pactype == 'Basic')
        {
            $packagearchitect = DB::table('drawingdetails')
            ->select('basicpack','id','drawingname','engtype')
            ->where('engtype','=',1)
            ->get();
        }
        elseif($pactype == 'Luxury')
        {
            $packagearchitect = DB::table('drawingdetails')
            ->select('luxurypack','id','drawingname','engtype')
            ->where('engtype','=',1)
            ->get();
        }
        elseif($pactype == 'Standard')
        {
            $packagearchitect = DB::table('drawingdetails')
            ->select('standardpack','id','drawingname','engtype')
            ->where('engtype','=',1)
            ->get();
        }
        else
        {
            $packagearchitect = DB::table('drawingdetails')
            ->select('premiumpack','id','drawingname','engtype')
            ->where('engtype','=',1)
            ->get();
        }

        if($pactype == 'Basic')
        {
            $packagestructural = DB::table('drawingdetails')
            ->select('basicpack','id','drawingname','engtype')
            ->where('engtype','=',2)
            ->get();
        }
        elseif($pactype == 'Standard')
        {
            $packagestructural = DB::table('drawingdetails')
            ->select('standardpack','id','drawingname','engtype')
            ->where('engtype','=',2)
            ->get();
        }
        elseif($pactype == 'Luxury')
        {
            $packagestructural = DB::table('drawingdetails')
            ->select('luxurypack','id','drawingname','engtype')
            ->where('engtype','=',2)
            ->get();
        }
        else
        {
            $packagestructural = DB::table('drawingdetails')
            ->select('premiumpack','id','drawingname','engtype')
            ->where('engtype','=',2)
            ->get();
        }

        $invID =0;
        $maxValue = DB::table('uploaddrawings')->max('id');
        $invID=$maxValue+1;
        $invID = str_pad($invID, 3, '0', STR_PAD_LEFT);
        $drawingid=$leadid."DG".$invID;

        return view('pages.uploaddraw',compact('packagearchitect','packagestructural','pactype','drawingid','leadid','drawid'));
    }


    public function uploaddrawings(Request $request)
    {
        // $uploadfile = $request->uploadfile;
        $pacid = $request->pacid;
        $pacname = $request->pacname;
        $drawid = $request->drawid;
        $leadid = $request->leadid;

        $uploadimg = $request->uploadfile;
        // dd($uploadimg);
        if($allimgupload = $request->file('uploadfile'))
        {
             foreach($allimgupload as $key => $uploadimg)
            // foreach($allimgupload as $uploadimg)
            {
                $pacid = $request->pacid[$key];
                $pacname = $request->pacname[$key];
                $drawid = $request->drawid[$key];
                $leadid = $request->leadid[$key];
                $pactype = $request->pactype[$key];

            //  $name = $uploadimg->getClientOriginalName();
            //  $extension = $uploadimg->getClientOriginalExtension();
            //  $filename = $name;
            //  $img = Image::make($uploadimg->getRealPath());
            //  $img->save(public_path('images/'.$filename));
            //  $uploadfile = $filename;


              $name = $uploadimg->getClientOriginalName();
             $extension = $uploadimg->getClientOriginalExtension();
             $filename = $name;
             $uploadimg->move('images/',$filename);
             $uploadfile = $filename;

             $uploaddrawing = DB::table('uploaddrawings')
                 ->insert([
                    "pacid" => $pacid,
                    "pacname" => $pacname,
                    "drawid" => $drawid,
                    "leadid" => $leadid,
                    "filename" => $uploadfile,
                    "pactype" => $pactype
                 ]);

            }
        }


        //  return $uploaddrawing;

    }

    public function architechuploadstatus($leadid,$drawid)
    {
        $architechupdate = DB::table('drawings')
        ->select('*')
        ->where('leadid','=',$leadid)
        ->where('drawid','=',$drawid)
        ->update([
            "status"=> 1
        ]);

        $engid = DB::table('clients')
        ->select('*')
        ->where('leadid','=',$leadid)
        ->first();

        DB::table('notifications')
        ->insert([
            "notificationview"=>$leadid,
            "notificationstatus"=>0,
            "purposeid"=>$drawid,
            "purposename" => "All drawing uploaded successfully"
            ]);

        DB::table('notifications')
        ->insert([
            "notificationview"=>$engid->engineercode,
            "notificationstatus"=>0,
            "purposeid"=>$engid->clientcode,
            "purposename" => $engid->clientcode. " drawings uploaded successfully"
            ]);

        return $architechupdate;
    }

    public function clientapprove($id)
    {
        $clientapprove = DB::table('uploaddrawings')
        ->select('*')
        ->where('id','=',$id)
        ->update([
            "clientside_status"=>1
        ]);

        $getleadid = DB::table('uploaddrawings')
        ->select('*')
        ->where('id','=',$id)
        ->first();

        $engid = DB::table('drawings')
        ->select('*')
        ->where('leadid','=',$getleadid->leadid)
        ->first();

         DB::table('notifications')
        ->insert([
            "notificationview"=>$engid->engineerid,
            "notificationstatus"=>0,
            "purposeid"=>$engid->engineerid,
            "purposename" => "$engid->clientid Client Approve the image"
            ]);

        return $clientapprove;
    }

    public function aeapprove($id)
    {
        $aeapprove = DB::table('uploaddrawings')
        ->select('*')
        ->where('id','=',$id)
        ->update([
            "ae_status"=>1
        ]);

        $getarchitectid = DB::table('uploaddrawings')
        ->select('*')
        ->where('id','=',$id)
        ->first();

         $arctictid = DB::table('drawings')
        ->select('*')
        ->where('leadid','=',$getarchitectid->leadid)
        ->first();

         DB::table('notifications')
        ->insert([
            "notificationview"=>$arctictid->assigned_to,
            "notificationstatus"=>0,
            "purposeid"=>$arctictid->assigned_to,
            "purposename" => "$arctictid->assigned_to AE Approve the image"
            ]);

        return $aeapprove;
    }


    public function clientreject($id)
    {
        $clientreject = DB::table('uploaddrawings')
        ->select('*')
        ->where('id','=',$id)
        ->update([
            "clientside_status"=>2
        ]);

        $getleadid = DB::table('uploaddrawings')
        ->select('*')
        ->where('id','=',$id)
        ->first();

        $engid = DB::table('drawings')
        ->select('*')
        ->where('leadid','=',$getleadid->leadid)
        ->first();

         DB::table('notifications')
        ->insert([
            "notificationview"=>$engid->engineerid,
            "notificationstatus"=>0,
            "purposeid"=>$engid->clientid,
            "purposename" => "$engid->clientid Client Reject the image"
            ]);

        return $clientreject;
    }

    public function aereject($id)
    {
        $clientreject = DB::table('uploaddrawings')
        ->select('*')
        ->where('id','=',$id)
        ->update([
            "ae_status"=>2
        ]);

         $getarchitectid = DB::table('uploaddrawings')
        ->select('*')
        ->where('id','=',$id)
        ->first();

         $arctictid = DB::table('drawings')
        ->select('*')
        ->where('leadid','=',$getarchitectid->leadid)
        ->first();

         DB::table('notifications')
        ->insert([
            "notificationview"=>$arctictid->assigned_to,
            "notificationstatus"=>0,
            "purposeid"=>$arctictid->clientid,
            "purposename" => "$arctictid->assigned_to AE Reject the image"
            ]);

        return $clientreject;
    }

    public function drawingdetails($id)
    {
        $drawdetails = DB::table('drawings')
        ->select('*')
        ->where('clientid','=',$id)
        ->get();

        return view('pages.drawingdetails',compact('drawdetails','id'));
    }

    public function assigndrawing(Request $request)
    {
        $architect = $request->architect;
        $drawid = $request->drawid;

        $assigndraw = DB::table('drawings')
        ->select('*')
        ->where('drawid','=',$drawid)
        ->update([
                "assigned_to"=>$architect
            ]);

            DB::table('notifications')
            ->insert([
                "notificationview"=>$architect,
                "notificationstatus"=>0,
                "purposeid"=>$drawid,
                "purposename" => "$drawid Architect Head Assigned to the project"
                ]);
    }

    public function assignstructuraleng(Request $request)
    {
        $structuraleng = $request->structuraleng;
        $drawid = $request->drawid;

        $assignstructural = DB::table('drawings')
        ->select('*')
        ->where('drawid','=',$drawid)
        ->update([
                "assign_to_strceng"=>$structuraleng
            ]);

            DB::table('notifications')
            ->insert([
                "notificationview"=>$structuraleng,
                "notificationstatus"=>0,
                "purposeid"=>$drawid,
                "purposename" => "$drawid Structural Head Assigned to the project"
                ]);
    }

    public function deletedrawing($drawid)
    {
        $drawdelete = DB::table('uploaddrawings')
        ->select('*')
        ->where('id','=',$drawid)
        ->delete();

        return $drawdelete;
    }
}
