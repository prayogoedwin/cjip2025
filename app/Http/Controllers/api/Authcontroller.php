<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\UserInvestor;

class Authcontroller extends Controller
{
    // Login
    public function login(Request $request){
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
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

    public function userdetail(){
        $user = UserInvestor::where('id', Auth()->user()->id)->with('profile')->first();
        if($user->profile==null){
            $data = UserInvestor::where('id', Auth()->user()->id)->first();
            $profil = [
                "id" => 0,
                "user_id" => 0,
                "investor_name" => "",
                "jabatan" => "",
                "phone" => "",
                "nama_perusahaan" => "",
                "bidang_usaha" => "",
                "alamat" => "",
                "country" => "",
                "badan_hukum" => ""
            ];
            $data->profile = $profil;
            return response()->json($data, 200);
        }
        else{
            return response()->json($user, 200);
        }
    }

    public function logout(Request $request)
    {
        DB::table('oauth_access_tokens')
        ->where('user_id', Auth::user()->id)
        ->update([
            'revoked' => true
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Logout berhasil'
        ], 200);
    }

}
