<?php

namespace App\Http\Controllers;

use App\BloodProducts;
use App\Http\Resources\BloodProductResource;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ExpiredProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('blood.bank.staff');

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* BloodProducts::all()->filter(function($product){
                  if( Carbon::now()->diff($product->expire_on)->days<2)
                      echo $product;

                });*/
        return BloodProductResource::collection(BloodProducts::all()->filter(function ($product){
            if( Carbon::now()->diff($product->expire_on)->days<2)
                return $product;
        }));


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
