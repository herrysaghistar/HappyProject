<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = '/home';
    // protected function redirectTo()
    // {
    //     if (Auth::check()) {
    //         $user = Auth::user();
            
    //         if ($user->hasRole('admin')) {
    //             return '/admin';
    //         } elseif ($user->hasRole('hse')) {
    //             return '/hse';
    //         } elseif ($user->hasRole('kabeng')) {
    //             return '/kabeng';
    //         } elseif ($user->hasRole('kapro')) {
    //             return '/kapro';
    //         } elseif ($user->hasRole('spv')) {
    //             return '/spv';
    //         } elseif ($user->hasRole('karyawan')) {
    //             return '/karyawan';
    //         }
    //     }

    //     return '/home'; // Default redirect
    // }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
