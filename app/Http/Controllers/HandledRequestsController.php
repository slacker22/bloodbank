<?php

namespace App\Http\Controllers;

use App\BloodProducts;
use App\HandledRequests;
use App\Http\Resources\BloodProductResource;
use App\Http\Resources\HandledRequestResource;
use App\Http\Resources\RequestResource;
use App\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class HandledRequestsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return HandledRequestResource::collection(HandledRequests::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*$validator=$this->validator($request->all());
        if($validator->fails())
            return response()->json(['errors'=>$validator->errors()->all()],401);*/

        $request->validate([
            'request_id' => 'required|numeric',
            'status' =>'required|numeric',
            //'barcode' => 'required|array',
            //'barcode.*' => 'required|numeric',
        ]);

        if($request->get('status') ==1){

            $request->validate([
                'barcode' => 'required|array',
                'barcode.*' => 'required|numeric',
            ]);

        $bloodProduct = BloodProducts::whereIn('barcode',$request->get('barcode'))->pluck('id');
            //$products =
            $bloodProduct->map(function($product)use($request){
            $handledRequest = HandledRequests::create([
                'request_id' => $request->get('request_id'),
                'handled_by' => auth()->user()->staff->id,
                'blood_product_id' => $product,
            ]);

            //update request status from zero to one after handling a request
            Requests::where('id', $handledRequest->request_id)->update(['status' => 1]);
            //delete blood product after handling a request

            BloodProducts::where('id','=',$product)->delete();
            //return $handledRequest;
        });

            //return HandledRequestResource::collection($products);
            return new RequestResource(Requests::where('id',$request->get('request_id'))->first());

        }elseif($request->get('status') ==2){

            Requests::where('id', $request->get('request_id'))->update(['status' => 2]);

            return new RequestResource(Requests::where('id',$request->get('request_id'))->first());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\HandledRequests  $handledRequest
     * @return \Illuminate\Http\Response
     */
    public function show(HandledRequests $handledRequest)
    {
        return new HandledRequestResource($handledRequest);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\HandledRequests  $handledRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HandledRequests $handledRequest)
    {
        $validator=$this->validator($request->all());
        if($validator->fails())
            return response()->json(['errors'=>$validator->errors()->all()],401);
        $handledRequest->update($request->all());
        return new HandledRequestResource($handledRequest);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\HandledRequests  $handledRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(HandledRequests $handledRequest)
    {
        $handledRequest->delete();

    }

    public function validator($data)
    {
        $rules=[
            'request_id' => 'required|numeric',
            'blood_product_id' => 'required|numeric',
            'handled_by' => 'required|numeric',

        ];
        return Validator::make($data,$rules);
    }
}
