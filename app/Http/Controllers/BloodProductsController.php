<?php

namespace App\Http\Controllers;

use App\BloodProducts;
use App\Http\Resources\BloodProductResource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BloodProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return BloodProductResource::collection(BloodProducts::all());

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
        $bloodProduct = BloodProducts::create([
            'barcode'=>$request->get('barcode'),
            'blood_group_id'=>$request->get('blood_group_id'),
            'product_type_id'=>$request->get('product_type_id'),
            'storage_location_id'=>$request->get('storage_location_id'),
            'donor_activity_id'=>$request->get('donor_activity_id'),
            'expire_on'=>Carbon::now()->addMonths(3)->format('Y-m-d H:i:s'),


        ]);
        return new BloodProductResource($bloodProduct);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BloodProducts  $bloodProduct
     * @return \Illuminate\Http\Response
     */
    public function show(BloodProducts $bloodProduct)
    {

        return new BloodProductResource($bloodProduct);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BloodProducts  $bloodProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BloodProducts $bloodProduct)
    {
        $validator=$this->validator($request->all());
        if($validator->fails())
            return response()->json(['errors'=>$validator->errors()->all()],401);
        $bloodProduct->update($request->all());
        return response()->json($bloodProduct,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BloodProducts  $bloodProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(BloodProducts $bloodProduct)
    {


        $bloodProduct->delete();

    }


    public function validator($data)
    {
        $rules=[
            'barcode' => 'required|numeric',
            'blood_group_id' => 'required|numeric',
            'product_type_id' => 'required|numeric',
            'storage_location_id' => 'required|numeric',
            'donor_activity_id' => 'required|numeric',
            //'expire_on' => 'required|date_format:Y-m-d H:i:s',

        ];
        return Validator::make($data,$rules);
    }
}
