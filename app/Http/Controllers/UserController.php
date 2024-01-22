<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function formcontroller(Request $request){

        $nome = $request->input('nome');
        $username = $request->input('username');
        $senha = $request->input('senha');


        $validator = Validator::make($request->all(), [

            'nome' => 'required',
            'username' => 'required|max:230',
            'senha' => [
                'required',
                'min:8',
                'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$@#%]).*$/',
            ]
        ]);
        
        //dd($validator->fails());
        if($validator->fails()){
            return $validator->getMessageBag();
        }


        // Verificar se o usuário já existe
        $existingUser = User::where('users')->where('email', $username)->first();

        if ($existingUser) {
            return "Erro: Usuário com este e-mail já existe!";
        }

        try {
                                
            User::create([
                'name' => $nome,
                'email' => $username,
                'password' => $senha,
            ]);


            return "Usuário cadastrado com sucesso!";
        } catch (\Exception $e) {
            return "Erro ao cadastrar usuário: " . $e->getMessage();
        }

    }
}



?>