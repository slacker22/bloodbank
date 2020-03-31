<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserTypeResource;
use App\UserTypes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return UserTypeResource::collection(UserTypes::all());
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
        $userType = UserTypes::create($request->all());
        return new UserTypeResource($userType);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserTypes  $userType
     * @return \Illuminate\Http\Response
     */
    public function show(UserTypes $userType)
    {
        return new UserTypeResource($userType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserTypes  $userType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserTypes $userType)
    {
        $validator=$this->validator($request->all());
        if($validator->fails())
            return response()->json(['errors'=>$validator->errors()->all()],401);
        $userType->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserTypes  $userTypes
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserTypes $userTypes)
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
