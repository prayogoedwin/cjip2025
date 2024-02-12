<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class Slidercontroller extends Controller
{
    public function get(){
        $slider = Slider::all();
        foreach($slider as $data){
            $data->foto = url('storage/'.str_replace('\\', '/', $data->foto));
        }
        return response()->json($slider, 200);
    }

    // -------------------------------------EN--------------------------------------------

    // public function enget(){
    //     $slider = Slider::all();
    //     foreach($slider as $data){
    //         $data->foto = url('storage/'.str_replace('\\', '/', $data->foto));
    //         $data->title = $data->getTranslatedAttribute('title', 'en');
    //     }
    //     return response()->json($slider, 200);
    // }
}
