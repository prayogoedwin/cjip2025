<?php

namespace App\Http\Controllers\API\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotifPost;
use App\UserInvestor;
use App\Post;

class EmailController extends Controller
{
    // to use this on another controller use this code
    // app('App\Http\Controllers\API\v1\EmailController')->sendnotifpost();
    //
    public function sendnotifpost(){
        // $users = UserInvestor::get();
        // foreach ($users as $u => $user) {
        //     # code...
        //     $email[] = Mail::to($user->email)->send(new NotifPost($user->id));
        // }
        return view('email.notif_post');
        $user = UserInvestor::first();
        $post = Post::first();
        $email = Mail::to('zulham724@students.unnes.ac.id')->send(new NotifPost($user,$post));
        return response()->json('Email was sent');
    }
}
