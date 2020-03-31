<?php

namespace App\Http\Controllers;

use App\DonorActivity;
use App\Http\Middleware\Donor;
use App\Http\Resources\DonorActivityResource;
use App\Http\Resources\DonorResource;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Collection;
use function GuzzleHttp\Promise\all;

class DonorInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showActivities()
    {
        if(!is_null(auth()->user()->donor))
        //return DonorActivityResource::Collection(auth()->user()->donor->donorActivities);
            $id = auth()->user()->donor->id;
        return DonorActivityResource::collection(DonorActivity::whereIn('donor_id',[$id])->get());

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
    public function showInfo()
    { if(!is_null(auth()->user()->donor))
        return new DonorResource(auth()->user()->donor);
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
