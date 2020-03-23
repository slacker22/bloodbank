<?php

namespace App\Http\Controllers;

use App\Http\Resources\RequestResource;
use App\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RequestsController extends Controller
{
    public function __construct()
    {
        $this->middleware('doctor',['only'=>['index','show','store']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return RequestResource::collection(Requests::all());
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
        $requestt = Requests::create($request->all());
        return new RequestResource($requestt);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Requests  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Requests $request)
    {
        return new RequestResource($request);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Requests  $requests
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Requests $requests)
    {
        $validator=$this->validator($request->all());
        if($validator->fails())
            return response()->json(['errors'=>$validator->errors()->all()],401);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Requests  $requests
     * @return \Illuminate\Http\Response
     */
    public function destroy(Requests $requests)
    {
        //
    }

    public function validator($data)

    {   //$current_time=\Carbon\Carbon::now();
        $today = \Carbon\Carbon::today()->format('Y-m-d');

        $rules=[
            'patient_id' => 'required|numeric',
            'blood_group_id' => 'required|numeric',
            'product_type_id' => 'required|numeric',
            'quantity' => 'required|numeric',
            'priority' => 'required|numeric',
            //'required_date' => ['date_format:Y-m-d H:i:s',"after_or_equal:$current_time"],
            'required_date' => ['date_format:Y-m-d',"after_or_equal:$today"],
            'submitted_by' => 'required|numeric',
            'status' => 'required|numeric',

        ];
        return Validator::make($data,$rules);
    }
}
