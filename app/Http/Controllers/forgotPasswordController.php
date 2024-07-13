<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Session;
use Exception;

class forgotPasswordController extends Controller
{
    public function create()
    {
        return view('auth.forgot-password');
    }
    public function sendLink(Request $request)
    {
            $email = $request->email;
            Log::info('Forgot Password Request for Email: ', [$email]);
            $fetchEmail = DB::table('users')->where('email', $email)->first();
            if ($fetchEmail) {
                Log::info('Record Found for the Email: ', [$email]);
                $to = $fetchEmail->email;
                $subject = "Singh Brothers, Password Reset Link !!";
                $message = "
                    Hi " . $fetchEmail->name . ",
                    <br><br>
                    Here is your password reset Link: " . env('APP_URL') . "/" . $fetchEmail->id . "/" . $fetchEmail->password . ".
                    <br><br>
                    Kindly Reset your password by clicking on this link.
                    <br><br>
                    Thanks !!
                ";
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= 'From: <' . env('MAIL_FROM_ADDRESS') . '>';
                $emailer = mail($to, $subject, $message, $headers);

                if ($emailer) {
                    Log::info('Reset password email sent successfully !!');
                    return redirect()->back()->with('success', 'Password reset link has been sent to your email, Kindly check your Email`s Inbox/Spam Folders.');
                } else {
                    Log::error('Emailer Failed Here...... ');
                    throw ValidationException::withMessages([
                        'email' => env('COMMON_EXCEPTION_MESSAGE'),
                    ]);
                }
            } else {
                Log::info('Record Not Found for the Email: ', [$email]);
                throw ValidationException::withMessages([
                    'email' => env('FORGOT_PASSWORD_REQUEST_ERROR'),
                ]);
            }

    }
}
