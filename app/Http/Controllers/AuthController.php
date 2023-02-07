<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.content.login');
    }
    public function register()
    {
        return view('auth.content.register');
    }

    public function authentication(Request $request)
    {
        $credential = $request->except('_token');
        $user = User::where('phone_number', $credential['phone_number'])->get()->toArray();
        if (count($user) === 1) {
            Cookie::queue(Cookie::make('phone_number', $credential['phone_number'], 425, '/'));
            Cookie::queue(Cookie::make('auth', $user[0]['pin_authentication'], 425, '/'));
            Cookie::queue(Cookie::make('temp', json_encode($user[0]), 425, '/'));
            return redirect()->route('auth.doTwoFactoryAuth');
        } else {
            Cookie::queue(Cookie::make('phone_number', $credential['phone_number'], 425, '/'));
            return redirect()->route('auth.createPinAuthentication');
        };
    }

    public function doTwoFactoryAuth()
    {
        $phoneNumber = Cookie::get('phone_number');
        $pinAuthentication = Cookie::get('auth');
        dd('authentication is successfully', Cookie::get('phone_number'), Cookie::get('temp'), Cookie::get('auth'));
    }

    public function createPinAuth()
    {
        dd('pin created successfully', Cookie::get('phone_number'));
    }

    public function registration(Request $request)
    {
        dd($request->only('email', 'password', 'phone_number'));
    }
}
