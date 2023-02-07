<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Image;

class WorkcompleteController extends Controller
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

    public function workcompletedetails($clientid)
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

        return view('pages.workcompletedetails',compact('estimaterequests','clientid'));
    }

    public function imageupload(Request $request)
    {
        $clientcode = $request->clientcode;
        $estid = $request->estid;
        $engineercode = $request->engineercode;
        $stageid = $request->stageid;

        $images = $request->completeimages;

        // dd($images);

        if($multipleimg = $request->file('completeimages'))
        {
            $i=1;
            foreach($multipleimg as $images)
            {

                $extension = $images ->getClientOriginalExtension();
                $filename = time().'_work'.'.'.$i++.'.'.$extension;
                $img = Image::make($images->getRealPath());
                $img->save(public_path('images/'.$filename));
                $photo=$filename;

                //  $photo = $filename;

                DB::table('completionofworks')
                ->insert([
                    "clientcode" => $clientcode,
                    "engcode" => $engineercode,
                    "estid" => $estid,
                    "stageid" => $stageid,
                    "imagenames" =>$photo,
                    "image_status" => '0'
                ]);
            }



        }


    }

    public function imageapprove($id)
    {
        $imageapprove = DB::table('completionofworks')
        ->select('*')
        ->where('id','=',$id)
        ->update([
            "image_status" => "1"
        ]);

        return $imageapprove;
    }

    public function imagereject($id)
    {
        $imagereject = DB::table('completionofworks')
        ->select('*')
        ->where('id','=',$id)
        ->update([
            "image_status" => "2"
        ]);

        return $imagereject;
    }

    public function clientapproveimg($id)
    {
        $imageapprove = DB::table('completionofworks')
        ->select('*')
        ->where('id','=',$id)
        ->update([
            "client_status" => "1"
        ]);

        return $imageapprove;
    }

    public function clientrejectimg($id)
    {
        $imagereject = DB::table('completionofworks')
        ->select('*')
        ->where('id','=',$id)
        ->update([
            "client_status" => "2"
        ]);

        return $imagereject;
    }

    public function allimagesupload($stageid,$estid)
    {
        $completedimages = DB::table('completionofworks')
        ->select('*')
        ->where('stageid','=',$stageid)
        ->where('estid','=',$estid)
        ->where('client_status','!=',1)
        ->get();

        if($completedimages->count() == 0)
        {
            DB::table('completionofworks')
            ->select('*')
            ->where('stageid','=',$stageid)
            ->where('estid','=',$estid)
            ->update([
                "allimages_status"=>1
            ]);

            $payid = DB::table('payments')
            ->select('*')
            ->where('estimateid','=',$estid)
            ->where('stageid','!=',$stageid)
            ->where('approval_status','=',5)
            ->first();

            DB::table('payments')
            ->select('*')
            ->where('stageid','=',$payid->stageid)
            ->update([
                "approval_status"=>6
            ]);
        }

        return $completedimages->count();

    }
}
