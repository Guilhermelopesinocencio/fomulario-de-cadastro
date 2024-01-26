<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AtualizacaoController extends Controller
{

    function atualizarConfiguracoes(Request $request)
    {

        //dd($request->all());
        $registro = User::find();

        if ($registro) {
            $dadosAtuais = json_decode($registro->configuracoes, true);
            
            $novosDados = [
                'dados' => [
                   'nome' => $request->input('nome'),
                   'email' => $request->input('email'),
                   'futuro' => $request->input('futuro'),
                ]
            ];
            dd($request->all());
            $novosDados = array_merge($dadosAtuais, $novosDados);
            
            $registro->update(['configuracoes' => json_encode($novosDados)]);
    
            return true; 

        } else {

            return false; 
        }
    }





    







}
