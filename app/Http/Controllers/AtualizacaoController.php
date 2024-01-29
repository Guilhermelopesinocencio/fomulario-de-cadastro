<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AtualizacaoController extends Controller
{

    function atualizarConfiguracoes(Request $request, $id)
    {

        $user = User::find($id);

        if ($user) {
           
            $dadosAtuais = json_decode($user->configuracoes, true);

            if($dadosAtuais['status']  == 'Forte' ||  $dadosAtuais['status'] == null){
                
                $dadosAtuais['status'] = $request->input('status');

            }

            $novosDados = [
                'dados' => [
                   'nome' => $request->input('nome'),
                   'email' => $request->input('email'),
                   'endereco' => $request->input('endereco'),
                ]
            ];

            $novosDados = array_merge($dadosAtuais, $novosDados);
            
            $user->update(['configuracoes' => json_encode($novosDados)]);

            return response()->json(['success' => true]);
        } else {
            return response()->json(['erro' => false]);
        }
    }
}
