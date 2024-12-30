<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cadastro;
use Illuminate\Support\Facades\Crypt;
use PhpParser\Node\Stmt\TryCatch;

class MainController extends Controller
{
    
    
    public function home(){

        try{
    
            $clientes = Cadastro::get();
    
    
            return view("home", ["clientes" => $clientes]);

    
            } catch (\Exception $e) {
            return redirect()->route("errorPage")->with('error', 'Ocorreu um erro inesperado.');
            }  


    }



    public function create_project(Request $request){

        
        $request->validate([
            "name" => ["required", "min:3", "max:35"],
            "age" => ["required", "numeric", "max:110", "min: 0"],
            "email" => ["required", "email", "max:50", "unique"],
            'cpf' => ['required', 'regex:/^\d{3}\.\d{3}\.\d{3}-\d{2}$|^\d{11}$/', "unique"]

        ],
    [
        "required" => "Este campo é obrigatório",
        "numeric" => "Este campo aceita apenas numeros",
        "email" => "O email informado é inválido",
        "email.max" => "O tamanho de email máximo é de 500 caracteres",
        "email.unique" => "Já existe um cliente com este email cadastrado",
        "cpf.regex" => "O CPF informado é inválido",
        "cpf.unique" => "Já existe um cliente com este CPF cadastrado",
        "name.min" => "O numero mínimo é de 3 caracteres",
        "name.max" => "O máximo é de 35 caracteres",
        "age.max" => "A idade máxima é de 110 anos",
        
    ]);

    $cliente =  new Cadastro;
    $cliente -> name = strip_tags($request->name);
    $cliente -> age = strip_tags($request->age);
    $cliente -> cpf = strip_tags($request->cpf);
    $cliente -> email = strip_tags($request->email);
    $cliente -> save();



        return redirect()->route("home");

    }


    public function delete_cliente(Request $request){

        try{

            $cliente_id = Crypt::decrypt($request->cliente_id);

            $cliente = Cadastro::where("id", $cliente_id)->first();
            
            if(!$cliente){
                return redirect()->route("home");
            }

            $cliente->forceDelete();

            return redirect()->route("home");

        }catch(\Exception $e){

        }

    }


}
