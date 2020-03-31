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
        //middleware for both doctor staff
        $this->middleware('can.access.patient')->only(['index','show']);
        $this->middleware('hospital.staff')->only(['store','update','destroy']);
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

    public function findPatientBySSN($request)
    {
        //validation => ssn is required
        $this->validate($request,
            [
                'ssn' => 'required|string|regex:/^(2|3)[0-9][1-9][0-1][1-9][0-3][1-9](01|02|03|04|11|12|13|14|15|16|17|18|19|21|22|23|24|25|26|27|28|29|31|32|33|34|35|88)\d\d\d\d\d$/',
            ]
        );

        return new PatientResource(Patients::where('ssn',$request->get('ssn'))->get());
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
        $patients->update($request->all());
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
            'ssn' => 'required|string|regex:/^(2|3)[0-9][1-9][0-1][1-9][0-3][1-9](01|02|03|04|11|12|13|14|15|16|17|18|19|21|22|23|24|25|26|27|28|29|31|32|33|34|35|88)\d\d\d\d\d$/|unique:patients',
            'gender' => 'required|numeric',
            'phone' => 'required|string|regex:/^(010|011|012|015){1}[0-9]{8}$/|unique:patients',
            'blood_group_id' => 'required|numeric',


        ];
        return Validator::make($data,$rules);
    }
}
