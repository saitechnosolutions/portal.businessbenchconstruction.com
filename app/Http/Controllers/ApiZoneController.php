<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Exception;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ApiZoneController extends Controller
{
    public function invalidId()
    {
        return response(["message" => "Invalid ID", "status" => 500], 500);
    }

    public function validationInvalid($errors)
    {
        return response(["message" => $errors, "status" => 400], 400);
    }

    public function successResponse($data)
    {
        return response(["message" => "success", "data" => $data, "status" => 200]);
    }


    public function index()
    {
        $zones = Zone::all()->sortByDesc("id");
        $districts = Area::all("district_name")->pluck("district_name")->unique();
        return view("pages.create_zone", compact('zones', "districts"));
    }

    public function createZone(Request $request)
    {
        try {
            $request->validate([
                "zone_id" => "required",
                'district_name.*' => 'required',
                "district_code.*" => "required",

            ]);
        } catch (ValidationException $error) {
            return  $this->validationInvalid($error->errors());
        }

        $districtNames = $request->input("district_name");
        $districtCodes = $request->input("district_code");
        $data = [];

        foreach ($districtNames as $key => $district) {
            $area = new Zone();
            $area->zone_id =  strtoupper(trim($request->input("zone_id")));
            $area->district_name = strtoupper(trim($district));
            $area->district_code = strtoupper(trim($districtCodes[$key]));
            array_push($data, $area);
            $area->save();
        }

        return $this->successResponse($data);
    }
    public function getTaluk(Request $request, $id)
    {
        $districtCodes = Area::where("district_name", $id)->get()->pluck("district_code")->unique();
        $options =  view("pages.get_taluk", ["districtCodes" => $districtCodes])->render();
        return  $options;
    }


    public function editZone($id)
    {
        try {
            $data = Zone::findOrFail($id);
            $districtName = Area::all()->pluck("district_name")->unique();
            $districtCode = Area::all()->pluck("district_code")->unique();
        } catch (Exception $e) {
            return $this->invalidId();
        }
        $viewArea =  view("pages.edit_zone", compact("data", "districtName", "districtCode"))->render();

        return $viewArea;
    }




    // tables data to be re rendered
    public function renderZone()
    {
        $zones  = Zone::all()->sortByDesc("id");
        $tableView   = view("pages.render_zone", compact("zones"))->render();
        return $tableView;
    }


    // View Zone

    public function viewZone($id)
    {
        try {
            $data = Zone::findOrFail($id);
        } catch (Exception $e) {
            return $this->invalidId();
        }

        $viewZone =  view("pages.view_zone", ["data" => $data])->render();

        return $viewZone;
    }

    public function getDistrict()
    {
        $districts = Area::all("district_name")->pluck("district_name")->unique();
        return view("pages.get_district", compact("districts"));
    }




    // View All Zone
    public function viewAllZone()
    {
        $data = Zone::all();
        return $this->successResponse($data);
    }



    // UpdateZone
    public function updatezone(Request $request, $id)
    {
        try {
            $request->validate([
                'zone_id' => 'required',
                'district_name' => 'required',
                'district_code' => 'required',

            ]);
        } catch (ValidationException $e) {
            return $this->validationInvalid($e->errors());
        }

        try {
            $data = Zone::findOrFail($id);
        } catch (Exception $e) {
            return $this->invalidId();
        }

        $data->update([
            "zone_id" =>  strtoupper(trim($request->input("zone_id"))),
            "district_name" => strtoupper(trim($request->input("district_name"))),
            "district_code" => strtoupper(trim($request->input("district_code"))),
        ]);
        return $this->successResponse($data);
    }


    // To delete Zone
    public function deletezone($id)
    {
        try {
            $data = Zone::findOrFail($id);
        } catch (Exception $e) {
            return $this->invalidId();
        }
        $data->delete();
        return $this->successResponse($data);
    }
}
