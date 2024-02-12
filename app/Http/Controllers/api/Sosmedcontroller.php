<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserInvestor;

class Sosmedcontroller extends Controller
{
    public function registrasi(Request $request){
        $user = UserInvestor::create([
            'name'          => $request->name,
            'email'         => $request->email,
            'image'         => '',
            'provider_id'   => $request->provider_id,
            'provider'      => 'google',
        ]);
        $token =  $user->createToken('nApp')->accessToken;
        return response()->json([
            'success' => true,
            'message' => 'Registrasi Berhasil',
            'token' => $token
        ], 200);
    }

    public function login(Request $request){
        $user = UserInvestor::where('provider_id', $request->provider_id)->first();
        if($user){
            $token =  $user->createToken('nApp')->accessToken;
            return response()->json([
                'status' => 'Success',
                'token' => $token
            ], 200);
        }
        else{
            return response()->json(['error'=>'Unauthorised'], 401);
        }
    }
}
