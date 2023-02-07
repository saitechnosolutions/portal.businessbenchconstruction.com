<?php

namespace App\Http\Controllers;


use Illuminate\Validation\ValidationException;
use App\Models\Area;
use Illuminate\Http\Request;
use App\Models\Zone;
use Exception;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\DB;


class ApiCreateAreaController extends Controller
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

        $areas  = Area::all()->sortByDesc("id");


        return view("pages.create_area", compact("areas"));
    }

    //Create Area
    public function createArea(Request $request)
    {
        try {
            $request->validate([
                'district_name' => 'required',
                "district_code" => "required",
                "taluk_name.*" => "required",
                "taluk_code.*" => "required",
            ]);
        } catch (ValidationException $error) {
            return  $this->validationInvalid($error->errors());
        }


        $talukNames = $request->input("taluk_name");
        $talukCodes = $request->input("taluk_code");
        $data = [];

        foreach ($talukNames as $key => $taluk) {
            $area = new Area();
            $area->district_name =  strtoupper(trim($request->input("district_name")));
            $area->district_code = strtoupper(trim($request->input("district_code")));
            $area->taluk_name = strtoupper(trim($taluk));
            $area->taluk_code = strtoupper(trim($talukCodes[$key]));
            array_push($data, $area);
            $area->save();
        }

        return $this->successResponse($data);
    }




    // View Area
    public function viewArea($id)
    {
        try {
            $data = Area::findOrFail($id);
        } catch (Exception $e) {
            return $this->invalidId();
        }

        $viewArea =  view("pages.view_area", ["data" => $data])->render();

        return $viewArea;
    }


    // Get Method to view edit area
    public function editArea($id)
    {
        try {
            $data = Area::findOrFail($id);
        } catch (Exception $e) {
            return $this->invalidId();
        }

        $viewArea =  view("pages.edit_area", ["data" => $data])->render();

        return $viewArea;
    }


    // tables data to be re rendered
    public function renderArea()
    {
        $areas  = Area::all()->sortByDesc("id");
        $tableView   = view("pages.render_area", compact("areas"))->render();
        return $tableView;
    }


    // View All Area
    public function viewAllArea()
    {
        $data = Area::all();
        return $this->successResponse($data);
    }



    // UpdateArea
    public function updateArea(Request $request, $id)
    {
        try {
            $request->validate([
                'district_name' => 'required',
                "district_code" => "required",
                "taluk_name" => "required",
                "taluk_code" => "required",
            ]);
        } catch (ValidationException $e) {
            return $this->validationInvalid($e->errors());
        }
        try {
            $data = Area::findOrFail($id);
        } catch (Exception  $e) {
            return $this->invalidId();
        }
        $data->update([
            "district_name" =>  strtoupper(trim($request->input("district_name"))),
            "district_code" => strtoupper(trim($request->input("district_code"))),
            "taluk_name" => strtoupper(trim($request->input("taluk_name"))),
            "taluk_code" => strtoupper(trim($request->input("taluk_code"))),
        ]);

        return $this->successResponse($data);
    }


    // To Delete Area
    public function deleteArea($id)
    {
        try {
            $data = Area::findOrFail($id);
        } catch (Exception $e) {
            return $this->invalidId();
        }
        $data->delete();
        return $this->successResponse($data);
    }
}
