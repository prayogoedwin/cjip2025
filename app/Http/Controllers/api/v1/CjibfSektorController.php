<?php

namespace App\Http\Controllers\API\v1;

use App\CjibfSektor;
use App\Models\Investasi\SektorCjibf;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CjibfSektorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cjibfsektors = SektorCjibf::get();
        return response()->json($cjibfsektors);
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
     * @param  \App\CjibfSektor  $cjibfSektor
     * @return \Illuminate\Http\Response
     */
    public function show(SektorCjibf $cjibfSektor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CjibfSektor  $cjibfSektor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SektorCjibf $cjibfSektor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CjibfSektor  $cjibfSektor
     * @return \Illuminate\Http\Response
     */
    public function destroy(SektorCjibf $cjibfSektor)
    {
        //
    }
}
