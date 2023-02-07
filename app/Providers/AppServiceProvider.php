<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $areas = DB::table('areas')
        ->select('*')
        ->get();
        View::share('areas',$areas);


        $district = DB::table('areas')
        ->select('district_name','district_code')
        ->distinct('district_name')
        ->get();
        View::share('district',$district);

        $getusers = DB::table('users')
        ->select('*')
        ->get();
        View::share('getusers',$getusers);

        $getengineers = DB::table('engineers')
        ->select('*')
        ->get();
        View::share('getengineers',$getengineers);


        $getclients = DB::table('clients')
        ->select('*')
        ->get();
        View::share('clients',$getclients);


        $invID =0;
        $maxValue = DB::table('estimates')->max('id');
        $invID=$maxValue+1;
        $invID = str_pad($invID, 3, '0', STR_PAD_LEFT);
        $estid="BBEST".$invID;
        View::share('estid',$estid);

        $designations = DB::table('designations')
        ->select('*')
        ->get();
        View::share('designations',$designations);
        
        $region = DB::table('zones')
        ->select('*')
        ->groupby('zone_id')
        ->get();
        View::share('region',$region);

        $numofzones =DB::table('zones')
        ->select('zone_id')
        ->groupBy('zone_id')
        ->get();
        View::share('numofzones',$numofzones);

        $numofclients =DB::table('clients')
        ->select('*')
        ->get();
        View::share('numofclients',$numofclients);

        $numofusers =DB::table('users')
        ->select('*')
        ->get();
        View::share('numofusers',$numofusers);

        $numofengineers =DB::table('engineers')
        ->select('*')
        ->get();
        View::share('numofengineers',$numofengineers);
        
        $numofdrawings =DB::table('uploaddrawings')
        ->select('*')
        ->get();
        View::share('numofdrawings',$numofdrawings);
        
        $estimaterequests =DB::table('estimaterequests')
        ->select('*')
        ->where('admin_status','=',1)
        ->get();
        View::share('estimaterequests',$estimaterequests);



    }
}
