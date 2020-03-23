<?php

namespace App\Http\Controllers;

use App\Http\Resources\StorageLoactionResource;
use App\Http\Resources\StorageLocationResource;
use App\StorageLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StorageLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return StorageLocationResource::collection(StorageLocation::all());
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
        $storageLocation = StorageLocation::create($request->all());
        return new StorageLocationResource($storageLocation);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\StorageLocation  $storageLocation
     * @return \Illuminate\Http\Response
     */
    public function show(StorageLocation $storageLocation)
    {
        return new StorageLocationResource($storageLocation);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StorageLocation  $storageLocation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StorageLocation $storageLocation)
    {
        $validator=$this->validator($request->all());
        if($validator->fails())
            return response()->json(['errors'=>$validator->errors()->all()],401);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StorageLocation  $storageLocation
     * @return \Illuminate\Http\Response
     */
    public function destroy(StorageLocation $storageLocation)
    {
        //
    }

    public function validator($data)
    {
        $rules=[
            'name'=>'required|string|min:1|max:100',
        ];
        return Validator::make($data,$rules);
    }
}
