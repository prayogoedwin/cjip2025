<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Config;

class Configcontroller extends Controller
{
    public function gethp(){
        $hp = Config::where('nama', 'phone')->first();
        return response()->json($hp, 200);
    }
}
