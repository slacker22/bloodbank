<?php

namespace App\Http\Controllers;

use App\Http\Resources\VirusResource;
use App\Viruses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VirusesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return VirusResource::collection(Viruses::all());
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
        $virus = Viruses::create($request->all());
        return new VirusResource($virus);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Viruses  $virus
     * @return \Illuminate\Http\Response
     */
    public function show(Viruses $virus)
    {
        return new VirusResource($virus);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Viruses  $virus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Viruses $virus)
    {
        $validator=$this->validator($request->all());
        if($validator->fails())
            return response()->json(['errors'=>$validator->errors()->all()],401);
        $virus->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Viruses  $viruses
     * @return \Illuminate\Http\Response
     */
    public function destroy(Viruses $viruses)
    {
        //
    }

    public function validator($data)
    {
        $rules=[
            'name'=>'required|string|min:1|max:100|unique:viruses',


        ];
        return Validator::make($data,$rules);
    }
}
