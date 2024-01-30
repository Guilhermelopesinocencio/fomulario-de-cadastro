<?php

namespace App\Http\Controllers;

use App\Models\Endereco;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

class EnderecoController extends Controller
{
    public function salvarEndereco(Request $request)
    {
        // Validar se os dados estão presentes no $request
        if (!$request->has('endereco')) {
            return response()->json(['mensagem_erro' => 'Dados de endereço ausentes no request.'], 400);
        }

        // Validar os dados recebidos
        $validator = Validator::make($request->input('endereco'), [
            'cep' => 'required',
            'rua' => 'required',
            'logradouro' => 'required',
            'numero' => 'nullable',
            'complemento' => 'nullable',
        ], [
            'cep.required' => 'Campo CEP é obrigatório',
            'rua.required' => 'Campo Rua é obrigatório',
            'logradouro.required' => 'Campo Logradouro é obrigatório',
            'numero.required' => 'Campo Número é obrigatório',
            'complemento.required' => 'Campo Complemento é obrigatório',
        ]);

        if ($validator->fails()) {
            return response()->json(['mensagem_erro' => $validator->errors()], 400);
        }

        // Extrair dados do endereço
        $endereco = $request->input('endereco');

        // Salvar o endereço no banco de dados
        Endereco::create($endereco);

        // Retornar uma resposta de sucesso
        return response()->json(['mensagem_sucesso' => 'Endereço salvo com sucesso']);
    }
    /*
    public function printtela()
    {
        try{
            //vai atrais do banco de dados
            $endereco = enderecos::all();
            //retorna o resultado
            return response()->json(['usuarios' => $endereco->toArray()], 200);

        } catch (\Exception $e) {
            // Se der erro aparece a menssagem de erro
            return response()->json(['error' => 'Erro ao obter a lista de usuários. ' . $e->getMessage()], 500);
        }
    } 
    */






}
?>
