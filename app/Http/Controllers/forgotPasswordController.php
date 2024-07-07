<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class forgotPasswordController extends Controller
{
    public function create()
    {
        return view('auth.forgot-password');
    }
    public function action(Request $request)
    {
        // $email = $request->email;
        // $to = "somebody@example.com, somebodyelse@example.com";
        // $subject = "HTML email";

        // $message = "";

        // // Always set content-type when sending HTML email
        // $headers = "MIME-Version: 1.0" . "\r\n";
        // $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // // More headers
        // $headers .= 'From: <webmaster@example.com>' . "\r\n";
        // $headers .= 'Cc: myboss@example.com' . "\r\n";

        // mail($to, $subject, $message, $headers);
    }
}
