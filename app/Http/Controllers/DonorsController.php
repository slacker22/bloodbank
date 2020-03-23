<?php

namespace App\Http\Controllers;

use App\BloodProducts;
use App\Donors;
use App\Http\Resources\DonorResource;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DonorsController extends Controller
{
    public function __construct()
    {
        $this->middleware('donor',['only'=>'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DonorResource::collection(Donors::all()); // for many donors
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
           // 'user_type_id'=>$request->get('user_type_id'),
            'user_type_id'=>'5',
            'donor_type_id'=>$request->get('donor_type_id'),
            'phone'=>$request->get('phone'),
            'email'=>$request->get('email'),
            'user_name'=>$request->get('user_name'),
            'password'=>bcrypt($request->get('password')),
        ]);
        $donor=$user->donor()->create($request->all());
        //$donor = Donors::create($request->all());


        return new DonorResource($donor);
    }

    /**
     * Display the specified resource.
     *
     * @param Donors $donor
     * @return void
     */
    public function show(Donors $donor)
    {
        return new DonorResource($donor); //for only one donor

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Donors $donor
     * @return void
     */
    public function update(Request $request, Donors $donor)
    {
        $validator=$this->validator($request->all());
        if($validator->fails())
            return response()->json(['errors'=>$validator->errors()->all()],401);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Donors $donor
     * @return void
     */
    public function destroy(Donors $donor)
    {
        //
    }

    public function validator($data)
    {
        $rules=[
            'first_name' => 'required|string|min:2',
            'last_name' => 'required|string|min:2',
            'email' => 'sometimes|email|unique:users',
            'ssn' => 'required|string|unique:donors',
            'gender' => 'required|numeric',
            'phone' => 'required|string|unique:users',
            //'user_type_id' => 'required|numeric',
            'blood_group_id' => 'required|numeric',
            'donor_type_id' => 'required|numeric',

        ];
        return Validator::make($data,$rules);
    }
}
