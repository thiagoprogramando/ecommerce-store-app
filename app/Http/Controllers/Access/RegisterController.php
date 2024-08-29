<?php

namespace App\Http\Controllers\Access;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller {

    public function index($indicator = null) {

        return view('Access.register',  [
            'indicator' => $indicator
        ]);
    }

    public function createUser(Request $request) {

        $user = User::where('email', $request->email)->where('license', env('API_KEY'))->first();
        if($user) {
            return redirect()->route('login')->with('error', 'Já existe um usuário com esse Email!');
        }

        if($request->term <> 1 && $request->term <> 'on') {
            return redirect()->back()->with('error', 'É necessário concordar com nosso termos.');
        }

        $user = new User();
        $user->name     = $request->name;
        $user->phone    = $request->phone;
        $user->email    = $request->email;
        $user->password = bcrypt($request->password);
        $user->status   = 1;
        $user->api_key  = env('API_KEY');
        if($user->save()) {
            
            $credentials = $request->only(['email', 'password']);
            $credentials['password'] = $credentials['password'];
            if (Auth::attempt($credentials)) {
                return redirect()->route('ecommerce')->with('success', 'Boas compras!');
            } else {
                return redirect()->route('login')->with('success', 'Faça login para ter acesso aos benefícios da sua conta!');
            }
        }

        return redirect()->back()->with('error', 'Não foi possível cadastra-se, verifique seus dados e tente novamente!');
    }
}
