<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use TCG\Voyager\Facades\Voyager;
// use TCG\Voyager;

class Settingcontroller extends Controller
{
    public function why(){
        $data = [
            'why' => Voyager::setting('site.id_ket_why')
        ];
        return $data;
    }

    // public function whyen(){
    //     $data = [
    //         'why' => Voyager::setting('site.ket_why')
    //     ];
    //     return $data;
    // }
}
