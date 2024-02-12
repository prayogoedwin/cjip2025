<?php

namespace App\Http\Controllers\API\v1;

use App\KabKota;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KabKotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cities = \App\Models\General\Kabkota::all();
        return response()->json($cities);
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
     * @param  \App\KabKota  $kabKota
     * @return \Illuminate\Http\Response
     */
    public function show(\App\Models\General\Kabkota $kabKota)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\KabKota  $kabKota
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, \App\Models\General\Kabkota $kabKota)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\KabKota  $kabKota
     * @return \Illuminate\Http\Response
     */
    public function destroy(\App\Models\General\Kabkota $kabKota)
    {
        //
    }
}
