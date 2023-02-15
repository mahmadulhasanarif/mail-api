<?php

namespace App\Http\Controllers;

use App\Mail\myMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendMail(){
        $users = User::all();
        Mail::to("mahmudulhasan.art@gmail.com")->send(new myMail($users));
        return "send Mail Successfully";
    }
}
