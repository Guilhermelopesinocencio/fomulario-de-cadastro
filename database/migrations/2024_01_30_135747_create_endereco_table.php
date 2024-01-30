<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnderecoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enderecos', function (Blueprint $table) {
            $table->id();
            $table->string('cep');
            $table->string('rua');
            $table->string('logradouro');
            $table->string('numero')->nullable();
            $table->string('complemento')->nullable();
            $table->foreignId('user_id')->constrained('users'); //"foreignId" serve para coluna equivalente, em quanto, "constrained" referenciar a tabela e a coluna
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enderecos');
    }
}
