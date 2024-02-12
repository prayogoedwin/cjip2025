<?php

namespace App\Http\Controllers\API\v1;

use App\MailTemplate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MailTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $res = MailTemplate::get();
        return response()->json($res);
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
        $res = new MailTemplate();
        $res->fill($request->all());
        $res->save();
        return response()->json($res);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MailTemplate  $mailTemplate
     * @return \Illuminate\Http\Response
     */
    public function show(MailTemplate $mailTemplate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MailTemplate  $mailTemplate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $res = MailTemplate::findOrFail($id);
        $res->fill($request->all());
        $res->save();
        return response()->json($res);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MailTemplate  $mailTemplate
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $res = MailTemplate::findOrFail($id);
        $res->delete();
        return response()->json($res);
    }
}
