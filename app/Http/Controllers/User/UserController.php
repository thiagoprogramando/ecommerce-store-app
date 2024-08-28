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

    public function address(Request $request) {

        $user = User::find($request->id);
        if($user) {

            $adress = '';

            if(!empty($request->postal_code)) {
                $adress .= $request->postal_code;
            }

            if(!empty($request->address)) {
                $adress .= ' - '.$request->address;
            }

            if(!empty($request->num)) {
                $adress .= ', '.$request->num;
            }

            if(!empty($request->complement)) {
                $adress .= ' '.$request->complement;
            }

            if(!empty($request->city)) {
                $adress .= ' | '.$request->city;
            }

            if(!empty($request->state)) {
                $adress .= ' /'.$request->state;
            }

            $user->address = $adress;
            if($user->save()) {
                
                return redirect()->back()->with('success', 'Dados atualizados com sucesso!');
            }

            return redirect()->back()->with('error', 'Não foi possível encontrar os dados do Usuário!');
        }
    }

}
