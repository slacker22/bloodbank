<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductTypeResource;
use App\ProductTypes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ProductTypeResource::collection(ProductTypes::all());
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
        $productType = ProductTypes::create($request->all());
        return new ProductTypeResource($productType);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductTypes  $productType
     * @return \Illuminate\Http\Response
     */
    public function show(ProductTypes $productType)
    {
        return new ProductTypeResource($productType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductTypes  $productTypes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductTypes $productTypes)
    {
        $validator=$this->validator($request->all());
        if($validator->fails())
            return response()->json(['errors'=>$validator->errors()->all()],401);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductTypes  $productTypes
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductTypes $productTypes)
    {
        //
    }

    public function validator($data)
    {
        $rules=[
            'name'=>'required|string|min:1|max:50|unique:product_types',

        ];
        return Validator::make($data,$rules);
    }
}
