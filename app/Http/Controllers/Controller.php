<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getarea($id)
    {
        $getarea = DB::table('areas')
        ->select('*')
        ->where('district_code','=',$id)
        ->get();

        return $getarea;
    }

    public function getcolor()
    {
        $user = Auth::user()->usertype;

        return $user;
    }
}
