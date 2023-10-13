<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function verify_email()
    {
        return view('auth.verify');
    }

    public function password_email()
    {
        return view('auth.passwords.email');
    }

    public function password_reset()
    {
        return view('auth.passwords.reset');
    }
}
