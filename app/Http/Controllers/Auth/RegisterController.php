<?php

namespace App\Http\Controllers\Auth;

use App\Mail\VerifyEmail;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
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
    protected $redirectTo = '/my-profile';

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
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'verifyToken' => Str::random(40)
        ]);

        $thisuser = User::findOrFail($user->id);
        $this->sendEmail($thisuser);
        return $user;

    }

    public function sendEmail($thisuser)
    {
        Mail::to($thisuser['email'])->send(new VerifyEmail($thisuser));
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        return $this->registered($request, $user) ?:redirect(route('verify.message'))
            ->with('success', 'Your account has been created successfully, Please Check Your Inbox and Activate Your Account');
    }

    public function verifyMessage()
    {
        return view('auth.verify');
    }

    public function verifyEmail($email, $token)
    {
        $user = User::where(['email' => $email, 'verifyToken' => $token])->first();
        if ($user) {
            User::where(['email' => $email, 'verifyToken' => $token])->update(['status' => true, 'verifyToken' => null]);
            return redirect(route('login'))
                ->with('status', 'Your account has been activated successfully');
        } else {
            return redirect(route('verify.message'))
                ->with('error', 'Opps! Something went wrong. seems this link has been expired');
        }
    }
}
