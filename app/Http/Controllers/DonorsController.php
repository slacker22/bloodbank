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
    //donor controller is for staff only
    public function __construct()
    {
        $this->middleware('blood.bank.staff')->except(['show']);//staff

        //only donor could use show method
       // $this->middleware('donor')->only('show');

        //both donor and blood bank staff can use show method
        $this->middleware('can.access.donor.and.activity')->only('show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DonorResource::collection(Donors::all());
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
            'phone'=>$request->get('phone'),
            'email'=>$request->get('email'),
            'user_name'=>$request->get('first_name').'.'.$request->get('last_name').'.'.rand(100000,999999),
            'password'=>bcrypt($request->get('phone')),
            'user_type_id'=>5,
        ]);

        //$donor=$user->donor()->create($request->all());
        $donor=$user->donor()->create([
            'ssn'=>$request->get('ssn'),
            'blood_group_id'=>$request->get('blood_group_id'),
            'donor_type_id'=>2,
        ]);

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
        return new DonorResource($donor);

    }

    public function findDonorBySSN(Request $request)
    {
        //validation => ssn is required
        $this->validate($request,
            [
                'ssn' => ['required','string','regex:/^(2|3)[0-9][1-9][0-1][1-9][0-3][1-9](01|02|03|04|11|12|13|14|15|16|17|18|19|21|22|23|24|25|26|27|28|29|31|32|33|34|35|88)\d\d\d\d\d$/'],
            ]
        );

        return new DonorResource(Donors::where('ssn',$request->get('ssn'))->first());


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
        /*$validator=$this->validator($request->all());
        if($validator->fails())
            return response()->json(['errors'=>$validator->errors()->all()],401);*/

        $request->validate([
            'first_name' => 'required|string|min:2',
            'last_name' => 'required|string|min:2',
            'gender' => 'required|numeric',
            'phone' => ['required','string','regex:/^(010|011|012|015){1}[0-9]{8}$/',"unique:users,phone,$donor->user_id"],
            'email' => 'sometimes|email',
            'ssn' => ['required','string','regex:/^(2|3)[0-9][1-9][0-1][1-9][0-3][1-9](01|02|03|04|11|12|13|14|15|16|17|18|19|21|22|23|24|25|26|27|28|29|31|32|33|34|35|88)\d\d\d\d\d$/',"unique:donors,ssn,$donor->id"],
            'blood_group_id' => 'required|numeric',
        ]);
        $donor->user->update($request->only(['first_name','last_name','gender','phone','email']));//user attributes
        $donor->update($request->only(['ssn','blood_group_id']));//donor attributes
        return new DonorResource($donor);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Donors $donor
     * @return void
     */
    public function destroy(Donors $donor)
    {
        $donor->delete();
        $donor->user()->delete();
    }

    public function validator($data)
    {
        $rules=[
            'first_name' => 'required|string|min:2',
            'last_name' => 'required|string|min:2',
            'gender' => 'required|numeric',
            'phone' => ['required','string','regex:/^(010|011|012|015){1}[0-9]{8}$/','unique:users'],
            'email' => 'sometimes|email',
            'ssn' => ['required','string','regex:/^(2|3)[0-9][1-9][0-1][1-9][0-3][1-9](01|02|03|04|11|12|13|14|15|16|17|18|19|21|22|23|24|25|26|27|28|29|31|32|33|34|35|88)\d\d\d\d\d$/','unique:donors'],
            'blood_group_id' => 'required|numeric',


        ];
        return Validator::make($data,$rules);
    }
}
