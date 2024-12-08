<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactUs;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;

class MailController extends Controller
{
    public function send(Request $request): RedirectResponse
    {
        $data = $request->validate([
            "first-name" => ["required", "string", "max:80"],
            "last-name" => ["required", "string", "max:80"],
            "email" => ["required", "email", "max:255"],
            "subject" => ["required", "string", "max:80"],
            "message" => ["required", "string", "max:500"],
        ]);

        try {
            Mail::to("Keyosk46@gmail.com")->send(new ContactUs($data));
            return redirect()->route('contact')->with('success', 'Your message has been sent!');
        } catch (\Exception $e) {
            report($e);
            return redirect()->route('contact')->with('error', 'We could not send your message. Please try again later.');
        }
    }
}
