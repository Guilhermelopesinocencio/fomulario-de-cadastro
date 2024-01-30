<?php

namespace App\Http\Controllers;

use App\Models\Endereco;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

class EnderecoController extends Controller
{
    
    public function salvarEndereco(Request $request){
        
        $endereco = $request->input('endereco');
        //dd($endereco);

        
        $cep = $endereco['cep'];
        $rua = $endereco['endereco'];
        $logradouro = $endereco['endereco'];
        $numero = $endereco['numero'];
        $complemento = $endereco['complemento'];

        $validar = [
            'cep' => 'required',
            'rua' => 'required',
            'logradouro' => 'required',
        ];

        $menssagens = [
            'cep.required' => 'Campo Obrigatorio',
            'rua.required' => 'Campo Obrigatorio',
            'logradouro' => 'Campo Obrigatorio',
        ];


        $validator = Validator::make($request->all(), $validar, $menssagens);
        
        if ($validator->fails()) {
            //dd($validator);
            return response()->json(['mensagem_erro' => $validator->errors()]);
        }else{
            $endereco = new Endereco($request->all());
            $endereco->save();
            
            return redirect('/sucesso');
            }
    
            Schema::create('enderecos', function (Blueprint $table) {
                $table->foreignId('usuario_id')->constrained();

            });
    
    
        }

}
