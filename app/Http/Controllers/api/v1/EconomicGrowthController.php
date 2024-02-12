<?php

namespace App\Http\Controllers\API\v1;

use App\EconomicGrowth;
use App\Models\Investasi\PertumbuhanEkonomi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EconomicGrowthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $res = PertumbuhanEkonomi::get();
        return response()->json($res);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\EconomicGrowth  $economicGrowth
     * @return \Illuminate\Http\Response
     */
    public function show(PertumbuhanEkonomi $economicGrowth)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EconomicGrowth  $economicGrowth
     * @return \Illuminate\Http\Response
     */
    public function edit(PertumbuhanEkonomi $economicGrowth)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EconomicGrowth  $economicGrowth
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PertumbuhanEkonomi $economicGrowth)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EconomicGrowth  $economicGrowth
     * @return \Illuminate\Http\Response
     */
    public function destroy(PertumbuhanEkonomi $economicGrowth)
    {
        //
    }
}
