<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{UserInvestor, Password_reset};
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\Resetpassword;

class Usercontroller extends Controller
{
    public function register(Request $request){
        $rules=[
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ];

        $messages = [
            "name.required" => "Name must be filled",
            "email.required" => "Email is required",
            "email.email" => "Invalid email id given.",
            "password.required" => "Password must be filled",
            "confirm_password.required" => "Confirm Password must be filled",
            "confirm_password.same" => "Confirm Password does not match Password",
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
            $user = UserInvestor::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            if($user){
                $token =  $user->createToken('nApp')->accessToken;
                return response()->json([
                    'success' => true,
                    'message' => 'Registrasi Berhasil',
                    'token' => $token
                ], 200);
            }
            else{
                return response()->json([
                    'success' => false,
                    'message' => 'Registrasi Gagal!'
                ], 401);
            }
        }
    }

    // Change password user investor
    public function changepass(Request $request){
        $user = Auth()->user();
        $validator = Validator::make($request->all(), [
            'old_pass' => 'required',
            'new_pass' => 'required',
            'cnf_pass' => 'required|same:new_pass'
        ]);
        if($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => 'Silahkan cek kembali inputan anda!',
                'data'    => $validator->errors()
            ], 400);
        }
        else{
            if(Hash::check($request->old_pass, $user->password)) {
                UserInvestor::where('id', $user->id)->update([
                    'password' => Hash::make($request->new_pass)
                ]);
                return response()->json([
                    'success' => true,
                    'message' => 'Password berhasil diubah!'
                ], 200);
            }
            else{
                return response()->json([
                    'success' => false,
                    'message' => 'Password yang anda masukkan tidak sesuai dengan password lama anda!'
                ], 401);
            }
        }
    }

    // Forgot Password
    public function forgot(Request $request){
        $user = UserInvestor::where('email', $request->email)->first();
        if($user){
            $token = Str::random(150);
            Password_reset::create([
                'email' => $user->email,
                'token' => $token,
                'created_at' => date('Y-m-d H:i:s')
            ]);
            Mail::to($user->email)->send(new Resetpassword($token));
            return response()->json([
                'success' => true,
                'message' => 'Silahkan cek email anda'
            ], 200);
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Email tidak ditemukan'
            ], 404);
        }
    }

}
