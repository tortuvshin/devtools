<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Person;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;

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
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

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
     * Show the registration form.
     *
     * @return void
     */
    protected function showRegistrationForm()
    {
        return view('auth.register', [
            'email' => session()->has('email') ? session()->get('email') : ''
        ]);
    }

    /**
     * Process the user registration.
     *
     * @return void
     */
    protected function register(Request $request)
    {
        $this->validate($request, $this->rules());

        $user = $this->createUser($request->all());

        auth()->login($user);

        return redirect($this->redirectTo);
    }

    /**
     * Return the registration validation rules
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ];
    }

    /**
     * Create a new user.
     *
     * @param  array  $data
     * @return User
     */
    protected function createUser(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        return $user;
    }

}