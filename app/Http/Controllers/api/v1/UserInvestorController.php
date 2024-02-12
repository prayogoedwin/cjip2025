<?php

namespace App\Http\Controllers\API\v1;

use App\UserInvestor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserInvestorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $res = UserInvestor::get();
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserInvestor  $userInvestor
     * @return \Illuminate\Http\Response
     */
    public function show(UserInvestor $userInvestor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserInvestor  $userInvestor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserInvestor $userInvestor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserInvestor  $userInvestor
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserInvestor $userInvestor)
    {
        //
    }
}
