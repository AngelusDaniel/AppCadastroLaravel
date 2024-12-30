<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller

{

    public function view_registro(){
        return view("cadastro");
    }


    public function view_login(){
        return view("login");
    }



    public function create_user(Request $request){

        $request->validate([
            "username" => ["required", "unique:users", "min:3", "max:35", "regex:/^[A-Za-z0-9*_!#%&\']*$/"],
            "email" => ["required", "unique:users", "email", "max:50"],
            "password" => ["required", "min:7", "max:35", "regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*[!@?^-_*])[A-Za-z0-9!@?^-_*]+$/"],
            

        ],
        [
            "required" => "O campo é obrigatório",
            "username.unique" => "O nome de usuário já existe",
            "username.min" => "O numero mínimo é de 3 caracteres",
            "username.max" => "O número máximo é de 35 caracteres",
            "username.regex" => "O campo não permite espaços. Caracteres especiais permitidos (*_-!#%&')",

            "email.unique" => "O Email já está cadastrado",
            "email.email" => "O email deve ser um email válido",
            "email.max" => "O campo deve ter no máximo 50 caracteres",

            "password.min" => "O campo deve ter no mínimo 7 caracteres",
            "password.max" => "O campo deve ter no máximo 35 caracteres",
            "password.regex" => "A senha deve ter ao menos 1 letra maiúscula, uma letra minúscula, um número e um caractere especial (!@?^-_*)",
            
        ]
    );

    $user = new User();
    $user -> username = strip_tags($request->username);
    $user->email = strip_tags($request->email);

     $password = strip_tags($request->password);
    $user->password = bcrypt($password);
    $user->save();

    Auth::login($user);

    return redirect(route("home"));

    }


    public function authenticate(Request $request){

        $credentials = $request->validate([
            "username" => ["required", "min:3", "max:35", "regex:/^[A-Za-z0-9*_!#%&\']*$/"],
            "password" => ["required", "min:7", "max:40", "regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*[!@?^-_*])[A-Za-z0-9!@?^-_*]+$/"]
        ], 
        [
            "username.required" => "O campo de nome de usuário é obrigatório",
            "username.min" => "O numero mínimo é de 3 caracteres",
            "username.max" => "O número máximo é de 35 caracteres",
            "username.regex" => "O campo não permite espaços. Caracteres especiais permitidos (*_-!#%&')",
            "password.required" => "O campo de senha é obrigatório",
            "password.min" => "O campo de senha deve ter no mínimo 7 caracteres",
            "password.max" => "O campo de senha deve ter no máximo 40 caracteres",
            "password.regex" => "A senha deve conter uma letra maiúscula, uma minúscula,  um número e um caractere especial (*_-!#)"
        ]);

        $user = User::where("username", $request->username)->first();

        if(!$user){
            return back()->withInput()->with(["invalid_login"=>"Login Inválido"]);
        }

        if(!password_verify($request->password, $user->password)){

            return back()->withInput()->with(["invalid_login"=>"Login Inválido"]);

        };

        $request->session()->regenerate();
        Auth::login($user);

        return redirect()->route("home");


    }

    public function logout(){

        Auth::logout();

        return redirect()->route("home");

    }

}
