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

        DB::beginTransaction();

        try {
            $user = $this->create($request->all());

            if ($user instanceof MustVerifyEmail) {
                // Attempt to send verification email; if it fails, rollback
                $user->sendEmailVerificationNotification();
            }

            event(new Registered($user));

            DB::commit();

            $this->guard()->login($user);

            return $this->registered($request, $user)
                    ?: redirect($this->redirectPath());
        } catch (\Throwable $e) {
            DB::rollBack();
            if (isset($user) && $user->exists) {
                $user->delete();
            }

            return back()
                ->withInput($request->only('name', 'email'))
                ->withErrors(['email' => 'We could not send the verification email. Please try again later.']);
        }
    }
}
