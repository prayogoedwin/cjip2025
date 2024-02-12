<?php

namespace App\Http\Controllers\API\v1;

use App\PertumbuhanEkonomi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PertumbuhanEkonomiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $ekonomis = \App\Models\Investasi\PertumbuhanEkonomi::where('status', 1)->get();
        return response()->json($ekonomis);
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
     * @param  \App\PertumbuhanEkonomi  $pertumbuhanEkonomi
     * @return \Illuminate\Http\Response
     */
    public function show(\App\Models\Investasi\PertumbuhanEkonomi $pertumbuhanEkonomi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PertumbuhanEkonomi  $pertumbuhanEkonomi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, \App\Models\Investasi\PertumbuhanEkonomi $pertumbuhanEkonomi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PertumbuhanEkonomi  $pertumbuhanEkonomi
     * @return \Illuminate\Http\Response
     */
    public function destroy(\App\Models\Investasi\PertumbuhanEkonomi $pertumbuhanEkonomi)
    {
        //
    }
}
