<?php

namespace App\Http\Controllers\API\v1;

use App\JenisKatUserAir;
use App\Models\General\KategoriAir;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JenisKatUserAirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $JenisKatUserAirs = KategoriAir::get();
        return response()->json($JenisKatUserAirs);
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
     * @param  \App\JenisKatUserAir  $jenisKatUserAir
     * @return \Illuminate\Http\Response
     */
    public function show(KategoriAir $jenisKatUserAir)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\JenisKatUserAir  $jenisKatUserAir
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KategoriAir $jenisKatUserAir)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\JenisKatUserAir  $jenisKatUserAir
     * @return \Illuminate\Http\Response
     */
    public function destroy(KategoriAir $jenisKatUserAir)
    {
        //
    }
}
