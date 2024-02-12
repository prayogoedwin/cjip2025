<?php

namespace App\Http\Controllers\API\v1;

use App\JenisFaq;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JenisFaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $jenisfaqs = \App\Models\General\JenisFaq::with('faqs')->get();
        return response()->json($jenisfaqs);
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
     * @param  \App\JenisFaq  $jenisFaq
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $jenisFaq = \App\Models\General\JenisFaq::with('faqs')->findOrFail($id);
        return response()->json($jenisFaq);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\JenisFaq  $jenisFaq
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, \App\Models\General\JenisFaq $jenisFaq)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\JenisFaq  $jenisFaq
     * @return \Illuminate\Http\Response
     */
    public function destroy(\App\Models\General\JenisFaq $jenisFaq)
    {
        //
    }
}
