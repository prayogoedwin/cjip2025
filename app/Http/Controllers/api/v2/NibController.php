<?php

namespace App\Http\Controllers\api\v2;

use App\Http\Controllers\Controller;
use App\Models\SiRusa\Nib;
use Illuminate\Http\Request;

class NibController extends Controller
{
    public function index(){

        $result = Nib::get();

        return response()->json(['nibs' => $result]);

    }
}
