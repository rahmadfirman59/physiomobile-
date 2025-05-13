<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\PatientRequest;
use App\Services\PatientServices;
use App\Services\UserServices;
use Illuminate\Http\Request;
use Validator;

class PatientController extends Controller
{
    protected $patiensServices, $userService;

    public function __construct()
    {

        $this->patiensServices = new PatientServices();

        $this->userService = new UserServices();

    }

    public function index()
    {
        $data = $this->userService->all();

        return response()->json([
            'status' => 'success',
            'data' => $data,
        ], 200);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'id_type' => 'required',
            'id_no' => 'required',
            'gender' => 'required',
            'birthday' => 'required',
            'address' => 'required',
            'medium_acquisition' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $request->merge(["email" => strtolower($request->name).'@gmail.com', "password" => "123"] );
        $user = $this->userService->create($request->all());

        $patieont = array("user_id" => $user->id,"medium_acquisition" => $request->medium_acquisition);
        $this->patiensServices->create($patieont);

        return response()->json([
            'status' => 'success',
            'message' => "Patient created successfully",
        ], 201);
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'id_type' => 'required',
            'id_no' => 'required',
            'gender' => 'required',
            'birthday' => 'required',
            'address' => 'required',
            'medium_acquisition' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $request->merge(["email" => strtolower($request->name).'@gmail.com', "password" => "123"] );
        $user = $this->userService->update( $request->all(),$id);

        $patieont = array("medium_acquisition" => $request->medium_acquisition);
        $patieont = $this->patiensServices->update($patieont,$user->id);

        return response()->json([
            'status' => 'success',
            'message' => "Patient updated successfully",
        ], 200);
    }

    public function detail($id)
    {
        $data = $this->userService->one($id);

        return response()->json([
            'status' => 'success',
            'data' => $data,
        ], 200);
    }
}
