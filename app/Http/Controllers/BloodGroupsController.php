<?php

namespace App\Http\Controllers;

use App\BloodGroups;
use App\Http\Resources\BloodGroupResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BloodGroupsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return BloodGroupResource::collection(BloodGroups::all());
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
       $bloodGroup= BloodGroups::create($request->all());
        return new BloodGroupResource($bloodGroup);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BloodGroups  $bloodGroup
     * @return \Illuminate\Http\Response
     */
    public function show(BloodGroups $bloodGroup)
    {
        return new BloodGroupResource($bloodGroup);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BloodGroups  $bloodGroups
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BloodGroups $bloodGroups)
    {
        $validator=$this->validator($request->all());
        if($validator->fails())
            return response()->json(['errors'=>$validator->errors()->all()],401);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BloodGroups  $bloodGroups
     * @return \Illuminate\Http\Response
     */
    public function destroy(BloodGroups $bloodGroups)
    {
        //
    }

    public function validator($data)
    {
        $rules=[
            'name'=>'required|string|min:1|max:20'
        ];
        return Validator::make($data,$rules);
    }
}
