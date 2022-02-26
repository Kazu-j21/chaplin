<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Facades\BydAuth;

class UserController extends Controller
{
    public function getLogin()
    {
        if (BydAuth::check()) {
            return redirect()->route('home.index');
        }
        return view('login');
    }

    public function postLogin(Request $request)
    {
        if (BydAuth::attempt($request->user_name, $request->password)) {
            return redirect()->route('home.index');
        }
        return redirect()->route('user.getLogin')->with('flash_message', 'アカウント情報が間違っています');
    }

    public function logout()
    {
        BydAuth::logout();
        return redirect()->route('user.getLogin');
    }
}
