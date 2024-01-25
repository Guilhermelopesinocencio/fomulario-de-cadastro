<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateConfiguracoesColumnOnUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        // Obtém o usuário com o ID igual a 7
        $usuario = User::find(7);

        if ($usuario) {
            // Array de dados a serem adicionados à coluna "configuracao"
            $novoDadoConfiguracao = [
                "endereco" => [
                    "rua" => "João",
                    "numero" => 60
                ]
            ];
        }

        // Obtém os dados atuais da coluna "configuracao" e decodifica de JSON para array
        $configuracaoAtual = json_decode($usuario->configuracoes, true);

        // Adiciona os novos dados ao array existente
        $configuracaoAtual = array_merge($configuracaoAtual, $novoDadoConfiguracao);

        // Converte o array de volta para JSON e atribui à coluna "configuracao"
        $usuario->configuracoes = json_encode($configuracaoAtual);

        // Salva as alterações no banco de dados
        $usuario->save();



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        




    }
}
