<?php

namespace App\Site\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class AuthController extends Controller
{
    public function login(): View
    {
        return view('auth.login');
    }

    public function register(): View
    {
        return view('auth.register');
    }

    public function verify_email(): View
    {
        return view('auth.verify');
    }

    public function password_email(): View
    {
        return view('auth.passwords.email');
    }

    public function password_reset(): View
    {
        return view('auth.passwords.reset');
    }
}
