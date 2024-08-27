<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller {
    
    public function profile() {

        return view('User.profile');
    }

    public function updateUser(Request $request) {

        $user = User::find($request->id);
        if($user) {

            if(!empty($request->name)) {
                $data['name'] = $request->name;
            }

            if(!empty($request->cpfcnpj)) {
                $data['cpfcnpj'] = $request->cpfcnpj;
            }

            if(!empty($request->description)) {
                $data['description'] = $request->description;
            }

            if(!empty($request->email)) {
                $data['email'] = $request->email;
            }

            if(!empty($request->phone)) {
                $data['phone'] = $request->phone;
            }

            if(!empty($request->password)) {
                $data['password'] = $request->password;
            }

            if(!empty($request->photo)) {

                if ($user->photo) {
                    Storage::delete('public/' . $user->photo);
                }
    
                $path = $request->file('photo')->store('profile-photos', 'public');
                $data['photo'] = $path;
            }

            if($user->update($data)){
                return redirect()->back()->with('success', 'Dados atualizados com sucesso!');
            }

            return redirect()->back()->with('error', 'Não foi possível atualizar os dados!');
        }

        return redirect()->back()->with('error', 'Não foi possível encontrar os dados do Usuário!');
    }

}
