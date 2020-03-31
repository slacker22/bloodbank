<?php

namespace App\Http\Controllers;

use App\DonorActivity;
use App\Donors;
use App\Http\Resources\DonorActivityResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use function GuzzleHttp\Promise\all;

class DonorActivityController extends Controller
{
    public function __construct()
    {
        $this->middleware('blood.bank.staff')->except('show');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DonorActivityResource::collection(DonorActivity::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Donors $donor)
    {
        $validator=$this->validator($request->all());
        if($validator->fails())
            return response()->json(['errors'=>$validator->errors()->all()],401);
        //$donorActivity= $donor->donorActivities()->create($request->all());
//       DonorActivity::create($request->all());
        $donorActivity= DonorActivity::create($request->all());
     if(sizeof( $request->get('viruses'))>0)
        $donorActivity->viruses()->syncWithoutDetaching( $request->get('viruses'));
        return new DonorActivityResource($donorActivity);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DonorActivity  $donorActivity
     * @return \Illuminate\Http\Response
     */
    public function show(DonorActivity $donorActivity)
    {
        return new DonorActivityResource($donorActivity);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DonorActivity  $donorActivity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DonorActivity $donorActivity)
    {
        $validator=$this->validator($request->all());
        if($validator->fails())
            return response()->json(['errors'=>$validator->errors()->all()],401);
        $donorActivity->update($request->all());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DonorActivity  $donorActivity
     * @return \Illuminate\Http\Response
     */
    public function destroy(DonorActivity $donorActivity)
    {
        //
    }

    public function validator($data)
    {
        $rules=[
            'donor_id' =>'required|numeric',
            'product_type_id' => 'required|numeric',
            'temperature' =>'required|string',
            'weight' =>'required|string',
            'height' =>'required|string',
            'status' =>'required|numeric',
            'comments' =>'sometimes|min:3|max:1000',

        ];
        return Validator::make($data,$rules);
    }
}
