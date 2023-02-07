<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ApiDesignationController extends Controller
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
        $designations = Designation::all();
        return view("pages.designation", compact("designations"));
    }

    public function createDesignation(Request $request)
    {
        try {
            $request->validate([
                "designation_name" => "required"
            ]);
        } catch (ValidationException $error) {
            return  $this->validationInvalid($error->errors());
        }
        $data  = Designation::create([
            "designation_name" => $request->input("designation_name")
        ]);
        return $this->successResponse($data);
    }
    public function renderDesignation()
    {
        $designations  = Designation::all()->sortByDesc("id");
        $tableView   = view("pages.render_designation", compact("designations"))->render();
        return $tableView;
    }


    public function viewDesignation($id)
    {
        try {
            $data = Designation::findOrFail($id);
        } catch (Exception $e) {
            return $this->invalidId();
        }
        $viewDesignation =  view("pages.view_designation", ["data" => $data])->render();
        return $viewDesignation;
    }


    public function editDesignation($id)
    {
        try {
            $data = Designation::findOrFail($id);
        } catch (Exception $e) {
            return $this->invalidId();
        }
        $viewArea =  view("pages.edit_designation", compact("data"))->render();

        return $viewArea;
    }


    public function updateDesignation(Request $request, $id)
    {
        try {
            $request->validate([
                "designation_name" => "required"
            ]);
        } catch (ValidationException $e) {
            return $this->validationInvalid($e->errors());
        }

        try {
            $data = Designation::findOrFail($id);
        } catch (Exception $e) {
            return $this->invalidId();
        }

        $data->update([
            "designation_name" => strtoupper(trim($request->input("designation_name"))),
        ]);
        return $this->successResponse($data);
    }



    public function deleteDesignation($id)
    {
        try {
            $data = Designation::findOrFail($id);
        } catch (Exception $e) {
            return $this->invalidId();
        }
        $data->delete();
        return $this->successResponse($data);
    }
}
