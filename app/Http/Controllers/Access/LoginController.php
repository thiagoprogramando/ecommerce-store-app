<?php

namespace App\Http\Controllers\Access;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller {
    
    public function login() {

        return view('Access.login');
    }

    public function logon(Request $request) {

        $credentials                = $request->only(['email', 'password']);
        $credentials['password']    = $credentials['password'];
        $credentials['api_key']     = env('API_KEY');

        if (Auth::attempt($credentials)) {
            return redirect()->route('ecommerce')->with('success', 'Bem vindo(a)!');
        } else {
            return redirect()->back()->with('error', 'Credenciais inválidas!');
        }
    }

    public function logout() {

        Auth::logout();
        return redirect()->route('login')->with('success', 'Até breve!');
    }
}
