<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactUs;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function send(){
        $mail = request(['first-name', 'last-name', 'email', 'subject', 'message']);

        Mail::to('example@gmail.com')->send(new ContactUs($mail));

        return view('contact-us');
    }
}

