<?php

namespace App\Http\Controllers\API\v1;

use App\Models\Profile\ProfileKabkota;
use App\ProfilKabupaten;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfilKabupatenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
     * @param  \App\ProfilKabupaten  $profilKabupaten
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $res = ProfileKabkota::with('kabkota.namakota')->findOrFail($id);
        return response()->json($res);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProfilKabupaten  $profilKabupaten
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProfileKabkota $profilKabupaten)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProfilKabupaten  $profilKabupaten
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProfileKabkota $profilKabupaten)
    {
        //
    }
}
