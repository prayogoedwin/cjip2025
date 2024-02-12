<?php

namespace App\Http\Controllers\API\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use TCG\Voyager\Facades\Voyager;
use App\UserInvestor;
use App\ProfileInvestor;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    //
    //use AuthenticatesUsers;

    /*protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    public function login(Request $request){
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        // dd(Auth::guard('investor'));
        if (Auth::guard('investor')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
            return response()->json(Auth::guard('investor')->user()->load(['profile','loi_interests']));
        }
        return abort(404);
    }

    public function register(Request $request){
        $this->validator($request->all())->validate();
        $writer = UserInvestor::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        if (Auth::guard('investor')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

            return response()->json(Auth::guard('investor')->user()->load(['profile','loi_interests']));
        }
        return abort(404);
    }

    public function update(Request $request){
        $auth = Auth::guard('investor')->user();
        $auth->fill($request->all());
        $auth->save();

        if($request->has('profile')){
            $profile = ProfileInvestor::firstOrNew(['id' => $request->profile['id'] ?? 0]);
            $profile->fill($request->profile);
            $auth->profile()->save($profile);
        }

        return response()->json($auth->load('profile'));
    }*/
}
