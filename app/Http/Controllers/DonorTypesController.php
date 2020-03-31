<?php

namespace App\Http\Controllers;

use App\DonorTypes;
use App\Http\Resources\DonorTypesResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DonorTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DonorTypesResource::collection(DonorTypes::all());
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
        $donorType = DonorTypes::create($request->all());
        return new DonorTypesResource($donorType);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DonorTypes  $donorType
     * @return \Illuminate\Http\Response
     */
    public function show(DonorTypes $donorType)
    {
        return new DonorTypesResource($donorType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DonorTypes  $donorType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DonorTypes $donorType)
    {
        $validator=$this->validator($request->all());
        if($validator->fails())
            return response()->json(['errors'=>$validator->errors()->all()],401);
        $donorType->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DonorTypes  $donorTypes
     * @return \Illuminate\Http\Response
     */
    public function destroy(DonorTypes $donorTypes)
    {
        //
    }

    public function validator($data)
    {
        $rules=[
            'name'=>'required|string|min:1|max:50'
        ];
        return Validator::make($data,$rules);
    }
}
