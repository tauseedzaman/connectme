<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Twilio\Rest\Client;

class PhoneNumberVerificationController extends Controller
{
    public function verify_phone()
    {
        return view("auth.verify-phone");
    }


    public function verify_phone_number(Request $request)
    {
        $request->validate([
            "otp" => "required"
        ]);
        $user = User::find(auth()->id());
        if ($user->mobile_verification_code == $request->otp) {
            $user->mobile_verified_at = now();
            $user->save();

            return redirect(url("/"));
        } else {
            return back()->with("message", "invalid-otp");
        }
    }

    public function resent(Request $req)
    {
        $user = User::find(auth()->id());
        $otp = random_int(100000, 999999);
        $user->mobile_verification_code = $otp;
        $user->save();


        $sid = env("TWILIO_SID");
        $token = env("TWILIO_TOKEN");
        $client = new Client($sid, $token);

        $client->messages->create(
            $user->mobile,
            [
                "from" => env("TWILIO_Number"),
                'body' => 'Thanks for registering on ' . config("app.url") . "\n your OTP is: " . $otp
            ]
        );

        return redirect(RouteServiceProvider::VERIFY_PHONE)->with('status', 'verification-link-sent');
    }
}
