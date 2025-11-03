<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * The user has been registered.
     * Ensure verification email is sent and show the notice page.
     */
    protected function registered(Request $request, $user)
    {
        if ($user instanceof MustVerifyEmail && !$user->hasVerifiedEmail()) {
            $user->sendEmailVerificationNotification();
            return redirect()->route('verification.notice');
        }

        return redirect($this->redirectPath());
    }

    /**
     * Override default register to ensure user persists only if
     * verification email dispatch succeeds.
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        // Pre-registration: store data temporarily and email a confirmation link
        $token = Str::random(40);
        $payload = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];

        Cache::put('pre_reg_' . $token, $payload, now()->addMinutes(60));

        $confirmUrl = route('register.confirm', ['token' => $token]);

        // Send a styled HTML confirmation email with the confirmation link
        Mail::send('emails.register-confirm', [
            'confirmUrl' => $confirmUrl,
            'name' => $payload['name'],
        ], function ($message) use ($payload) {
            $message->to($payload['email'])
                ->subject('Confirm your registration');
        });

        // Show a neutral page asking user to check their email
        return redirect()->route('verification.notice')->with('resent', true);
    }

    /**
     * Handle click from pre-registration confirmation email.
     */
    public function confirm(Request $request)
    {
        $token = $request->route('token');
        $payload = Cache::pull('pre_reg_' . $token);

        if (!$payload) {
            return redirect()->route('register')->withErrors(['email' => 'The confirmation link is invalid or expired.']);
        }

        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $payload['name'],
                'email' => $payload['email'],
                'password' => Hash::make($payload['password']),
            ]);

            // Mark as verified immediately upon confirmed link click
            $user->forceFill(['email_verified_at' => now()])->save();

            event(new Registered($user));

            DB::commit();

            // Log in the user after successful confirmation
            $this->guard()->login($user);

            return redirect($this->redirectPath());
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->route('register')->withErrors(['email' => 'Could not complete registration. Please try again.']);
        }
    }
}
