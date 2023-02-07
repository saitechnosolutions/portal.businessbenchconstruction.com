<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;

class ProcessofworkController extends Controller
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

    public function processofworks($engid,$clientid)
    {
        $processofworks = DB::table('processofworks')
        ->select('*')
        ->where('clientcode','=',$clientid)
        ->where('engid','=',$engid)->orderBy('id','DESC')
        ->get()->take(20);

        return view('pages.processofworks',compact('engid','clientid','processofworks'));
    }

    public function processimageupload(Request $request)
    {
        $clientcode = $request->clientcode;
        $engineercode = $request->engineercode;

        $images = $request->processcompleteimages;

        // dd($images);

        if($multipleimg = $request->file('processcompleteimages'))
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

                DB::table('processofworks')
                ->insert([
                    "imagename" => $photo,
                    "clientcode" => $clientcode,
                    "engid" => $engineercode,

                ]);
            }



        }
    }
}
