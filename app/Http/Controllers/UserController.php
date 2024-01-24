<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function formcontroller(Request $request){

        $nome = $request->input('nome');
        $email = $request->input('email');
        $password = $request->input('password');


        $validator = Validator::make($request->all(), [
            'nome' => 'required',
            'email' => 'required|max:230',
            'password' => [
                'required',
                'min:6',
            ]
        ]);
        
        if($validator->fails()){
            dd($validator->errors());
            return response()->json(['mensagem_erro' => "deu merdar"]);
        }


        // Verificar se o usuário já existe
        $existingUser = User::where('email', $email)->first();

        if ($existingUser) {
            return response()->json(['success' => false, 'mensagem_erro' => 'Já existe esse email cadastrado'], 400);
        }
        try {    
                   
            User::create([
                'name' => $nome,
                'email' => $email,
                'password' => $password,
            ]);

            return response()->json(["success" => true,  "mensagem_erro" => "Usuário cadastrado com sucesso!"]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'mensagem_erro' =>  "Erro ao cadastrar usuário: " . $e->getMessage()], 400);
        }

    }
    
    public function printtela()
    {
        try{
            //vai atrais do banco de dados
            $users = User::all();
            //retorna o resultado
            return response()->json(['usuarios' => $users->toArray()], 200);

        } catch (\Exception $e) {
            // Se der erro aparece a menssagem de erro
            return response()->json(['error' => 'Erro ao obter a lista de usuários. ' . $e->getMessage()], 500);
        }
    } 


    public function login(Request $request){


        // Verificar se o usuário já está autenticado
        if (Auth::check()) {
        return response()->json(['success' => true, 'mensagem' => 'Usuário já está logado']);
    }

        $credentials = $request->validate([
            'email' => ['required', 'email', 'ends_with:gmail.com,hotmail.com'],
            'password' => ['required', 'min:8', 'max:16'],
        ]);
        
        //O método attempt irá retornar true se a autenticação for realizada com sucesso. Caso contrário irá retornar false.
        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'As informações fornecidas não estão no banco de dados! ',
        ]);

        if(Auth::check()){
            'Usuario já logado';
        }


    }

    /*
    public function handle($request, $next){
        
        return Auth::onceBasic() ?: $next($request);
    }
    */


}



?>