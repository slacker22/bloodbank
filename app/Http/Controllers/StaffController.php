<?php

namespace App\Http\Controllers;

use App\Http\Resources\StaffIndexResource;
use App\Http\Resources\StaffResource;
use App\Http\Resources\UserResource;
use App\Staff;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all staff data except current logged in user(Admin)
        return StaffResource::collection(Staff::all()->except(Auth::id()));
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
        $user = User::create([
            'first_name'=>$request->get('first_name'),
            'last_name'=>$request->get('last_name'),
            'gender'=>$request->get('gender'),
            'user_type_id'=>$request->get('user_type_id'),
            'phone'=>$request->get('phone'),
            'email'=>$request->get('email'),
            'user_name'=>$request->get('first_name').'.'.$request->get('last_name').'.'.rand(100000,999999),
            'password'=>bcrypt($request->get('phone')),
            //'user_name'=>$request->get('user_name'),
            //'password'=>bcrypt($request->get('password')),
        ]);
        $staff=$user->staff()->create();
        return new StaffResource($staff);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function show(Staff $staff)
    {
        return new StaffResource($staff);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Staff $staff)
    {
        /*$validator=$this->validator($request->all());
        if($validator->fails())
            return response()->json(['errors'=>$validator->errors()->all()],401);*/
        $staff->user->update($request->all());
        return response()->json($staff,200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function destroy(Staff $staff)
    {

        $staff->delete();

        return response()->json(null,204);
    }

    public function validator($data)
    {
        $rules=[
            'first_name' => 'required|string|min:2',
            'last_name' => 'required|string|min:2',
            'gender' => 'required|numeric',
            'phone' => ['required','string','regex:/^(010|011|012|015){1}[0-9]{8}$/','unique:users'],
            'email' => 'required|email|unique:users',
            //'user_name' => 'required|string|unique:users',
            //'password' => 'required',
            'user_type_id' => 'required|numeric',


        ];
        return Validator::make($data,$rules);
    }
}
