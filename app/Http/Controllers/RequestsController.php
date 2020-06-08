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

        $this->middleware('can.access.request')->only(['index','show']);
        $this->middleware('doctor')->only(['store','update','destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return RequestResource::collection(Requests::paginate(5));
        return RequestResource::collection(Requests::where('status','=',0)->get());
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
        $requestt = Requests::create([
            'patient_id' =>$request->get('patient_id'),
            'blood_group_id' =>$request->get('blood_group_id'),
            'product_type_id' =>$request->get('product_type_id'),
            'quantity' =>$request->get('quantity'),
            'priority' =>$request->get('priority'),
            'required_date' =>$request->get('required_date'),
            'submitted_by'=>auth()->user()->staff->id,
            'status'=>0,

        ]);
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
     * @param  \App\Requests  $Request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Requests $Request)
    {
        $validator=$this->validator($request->all());
        if($validator->fails())
            return response()->json(['errors'=>$validator->errors()->all()],401);
        $Request->update($request->all());
        return response()->json($Request,200);
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
        //$now = \Carbon\Carbon::today()->format('Y-m-d');

        $rules=[
            'patient_id' => 'required|numeric',
            'blood_group_id' => 'required|numeric',
            'product_type_id' => 'required|numeric',
            'quantity' => 'required|numeric',
            'priority' => 'required|numeric',
            'required_date' => ['required','date','date_format:Y-m-d','after_or_equal:' . date('Y-m-d'), ],
            //'required_date' => ['required','date_format:Y-m-d',"after_or_equal:$now"],
            //'submitted_by' => 'required|numeric',
            //'status' => 'required|numeric',

        ];
        return Validator::make($data,$rules);
    }
}
