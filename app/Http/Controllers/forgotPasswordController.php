<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Session;
use Exception;
use Illuminate\Support\Facades\Hash;
use App\Helpers\Helper;

class forgotPasswordController extends Controller
{
    public function create()
    {
        return view('auth.forgot-password');
    }
    public function renderResetPassword(Request $request, $id, $token){
        Log::info('Rendering Reset Password Page For User ID: ',[$id]);
        $verifyTheUser=DB::table('users')->where('id',$id)->first();
        if($verifyTheUser->forgot_password_key==$token){
            $userId=$id;
            return view('auth.new-password',compact('userId'));
        } else{
            return abort(404);
        }
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
                    Here is your password reset Link: " . env('APP_URL') . "/reset-password/" . $fetchEmail->id . "/" . $fetchEmail->forgot_password_key . ".
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
                    return redirect()->back()->with('success', env('PASSWORD_RESET_LINK_SENT'));
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

    public function resetPassword(Request $request){
        $userId=$request->userId;
        $password=Hash::make($request->password);
        $passwordKey=str_replace ('/', '', Hash::make($request->password));
        Log::info('Reset Password Request Started For User ID: ',[$userId]);
        try{
            DB::table('users')->where('id',$userId)->update(['password'=>$password,'forgot_password_key'=>$passwordKey]);
            return redirect('/login')->with('success', env('PASSWORD_RESET_LINK_SUCCESSFULL'));
        } catch (Exception $exception){
            Log::error('Exception While Resetting Password: ',[$exception->getMessage()]);
        }
    }
}
