<?php

namespace App\Http\Controllers\API\v1;

use App\MailCampaign;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;
use App\MailTemplate;
use App\CampaignableTemplate;

class MailCampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $res = MailCampaign::with('templates','recipient_investors')->get();
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
        $res = new MailCampaign();
        $res->fill($request->all());
        $res->sent = 0;
        $res->save();

        if($request->has('templates')){
            foreach ($request->templates as $t => $template) {
                $res->templates()->attach($template['id']);
            }
        }

        if($request->has('investor_recipients')){
            foreach ($request->investor_recipients as $ir => $investor_recipient) {
                # code...
                $res->recipient_investors()->attach($investor_recipient['id']);
            }
        }

        return response()->json($res->load('templates','recipient_investors'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MailCampaign  $mailCampaign
     * @return \Illuminate\Http\Response
     */
    public function show(MailCampaign $mailCampaign)
    {
        //
        $res = $mailCampaign->load('templates','recipient_investors','recipient_emails');
        return response()->json($res);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MailCampaign  $mailCampaign
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MailCampaign $mailCampaign)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MailCampaign  $mailCampaign
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        // CampaignableTemplate::where('mail_campaign_id',$id)->delete();
        $res = MailCampaign::findOrFail($id);
        $res->delete();
        return response()->json($res);
    }

}
