<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Sendmail;

class Emailcontroller extends Controller
{
    public function sendmail(){
        Mail::to('izzalutfi045@gmail.com')->send(new Sendmail());
        echo "email berhasil dikirim";
    }
}
