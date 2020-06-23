<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Request\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(){
        return view('auth.login');
    }

    public function authenticate(LoginRequest $request)
    {
        $dataLogin = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'active' => 1
        ];
        $remember = false;

        if (Auth::attempt($dataLogin, $remember)) {
            if (Auth::user()->hasRole('Administrador')) {
                return redirect(route('admin_home'));
            } elseif (Auth::user()->hasRole('Sucursal')) {
                return redirect(route('branch_home'));
            }
        }

        return redirect()->route('login')->withErrors([
            'email' => 'Usuario o contraseña incorrectos.'
        ])->withInput($request->all());
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect('/login');
    }
}
