<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddConfiguracaoAvancadoToUsuarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   

        
        $usuarios = User::all();


        //Arrey
        $customizacaoPadrao = [
            "nome" => "Illian",
            "status" => "Forte"
        ];

        $jsonString = json_encode($customizacaoPadrao);


        foreach ($usuarios as $usuario) {
            $usuario->configuracoes = $jsonString;
            $usuario->save();
        }

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
