<?php

namespace App\Http\Controllers;

use App\Http\Resources\PatientResource;
use App\Patients;
use App\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PatientsController extends Controller
{
    public function __construct()
    {
        $this->middleware('doctor',['only'=>['index','show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PatientResource::collection(Patients::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator=$this->validator($request->all());
        if($validator->fails())
            return response()->json(['errors'=>$validator->errors()->all()],401);
        $patient = Patients::create($request->all());
        return new PatientResource($patient);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Patients  $patient
     * @return \Illuminate\Http\Response
     */
    public function show(Patients $patient)
    {
        return new PatientResource($patient);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Patients  $patients
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patients $patients)
    {
        $validator=$this->validator($request->all());
        if($validator->fails())
            return response()->json(['errors'=>$validator->errors()->all()],401);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Patients  $patients
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patients $patients)
    {
        //
    }

    public function validator($data)
    {
        $rules=[
            'first_name' => 'required|string|min:2',
            'last_name' => 'required|string|min:2',
            'ssn' => 'required|string|unique:patients',
            'gender' => 'required|numeric',
            'phone' => 'required|string|unique:patients',
            'blood_group_id' => 'required|numeric',


        ];
        return Validator::make($data,$rules);
    }
}
