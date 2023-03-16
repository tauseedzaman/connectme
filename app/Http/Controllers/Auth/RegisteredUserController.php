<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Str;
use Twilio\Rest\Client;
class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'sometimes|string|email|max:255|unique:' . User::class,
            'tel' => 'sometimes|string|max:255|unique:users,mobile',
            'profile' => 'required|image|mimes:png,jpg,jpeg|max:1024',
            'gender' => 'required',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $profile = "";
        if ($request->file("profile")) {
            $profile = $request->file("profile")->store("profiles","public");
        }
        $user = User::create([
            'uuid'=>Str::uuid(),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'usernmae' => $request->usernmae,
            'gender' => $request->gender,
            'profile' => $profile ?? "",
            'email' => $request->email,
            'mobile' => $request->tel,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        if($request->email){
            auth()->user()->sendEmailVerificationNotification();

            return redirect(RouteServiceProvider::VERIFY)->with('status', 'verification-link-sent');
        }else{
            $user = User::find(auth()->id());
            $otp=random_int(100000,999999);
            $user->mobile_verification_code=$otp;
            $user->save();


            $sid = env("TWILIO_SID");
            $token = env("TWILIO_TOKEN");
            $client = new Client($sid, $token);

            // Use the client to do fun stuff like send text messages!
            $client->messages->create(
                // the number you'd like to send the message to
                $user->mobile,
                [
                    "from" => env("TWILIO_Number"),
                    // the body of the text message you'd like to send
                    'body' => 'Thanks for registering on '. config("app.name"). "\n your OTP is: ".$otp
                ]
            );

            return redirect(RouteServiceProvider::VERIFY_PHONE)->with('status', 'verification-link-sent');
        }
    }
}
