<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Investor\ProfileInvestor;
use Illuminate\Support\Facades\Validator;

class Profilinvestorcontroller extends Controller
{
    public function store(Request $request){
        $rules=[
            'investor_name' => 'required',
            'jabatan' => 'required',
            'phone' => 'required',
            'nama_perusahaan' => 'required',
            'bidang_usaha' => 'required',
            'alamat' => 'required',
            'country' => 'required',
            'badan_hukum' => 'required',
        ];

        $messages = [
            "investor_name.required" => "Name must be filled",
            "jabatan.required" => "must be filled",
            "phone.required" => "must be filled",
            "nama_perusahaan.required" => "must be filled",
            "bidang_usaha.required" =>  "must be filled",
            "alamat.required" => "must be filled",
            "country.required" => "must be filled",
            "badan_hukum.required" => "must be filled",
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => 'Silahkan cek kembali inputan anda',
                'data'    => $validator->errors()
            ], 400);
        }
        else{
            $profil_investor = ProfileInvestor::create([
                "investor_name" => $request->investor_name,
                "jabatan" => $request->jabatan,
                "phone" => $request->phone,
                "nama_perusahaan" => $request->nama_perusahaan,
                "bidang_usaha" => $request->bidang_usaha,
                "alamat" => $request->alamat,
                "country" => $request->country,
                "badan_hukum" => $request->badan_hukum,
                "user_id" => $request->user_id
            ]);

            if($profil_investor){
                return response()->json([
                    'success' => true,
                    'message' => 'Profil berhasil dilengkapi'
                ], 200);
            }
            else{
                return response()->json([
                    'success' => false,
                    'message' => 'Profil gagal dilengkapi!'
                ], 401);
            }
        }
    }

    public function update(Request $request){
        $rules=[
            'investor_name' => 'required',
            'jabatan' => 'required',
            'phone' => 'required',
            'nama_perusahaan' => 'required',
            'bidang_usaha' => 'required',
            'alamat' => 'required',
            'country' => 'required',
            'badan_hukum' => 'required',
        ];

        $messages = [
            "investor_name.required" => "Name must be filled",
            "jabatan.required" => "must be filled",
            "phone.required" => "must be filled",
            "nama_perusahaan.required" => "must be filled",
            "bidang_usaha.required" =>  "must be filled",
            "alamat.required" => "must be filled",
            "country.required" => "must be filled",
            "badan_hukum.required" => "must be filled",
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => 'Silahkan cek kembali inputan anda',
                'data'    => $validator->errors()
            ], 400);
        }
        else{
            $profil_investor = ProfileInvestor::where('user_id', $request->user_id)->update([
                "investor_name" => $request->investor_name,
                "jabatan" => $request->jabatan,
                "phone" => $request->phone,
                "nama_perusahaan" => $request->nama_perusahaan,
                "bidang_usaha" => $request->bidang_usaha,
                "alamat" => $request->alamat,
                "country" => $request->country,
                "badan_hukum" => $request->badan_hukum
            ]);

            if($profil_investor){
                return response()->json([
                    'success' => true,
                    'message' => 'Profil berhasil diubah'
                ], 200);
            }
            else{
                return response()->json([
                    'success' => false,
                    'message' => 'Profil gagal diubah!'
                ], 401);
            }
        }
    }
}
