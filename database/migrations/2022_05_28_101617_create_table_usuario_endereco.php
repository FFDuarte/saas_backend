<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios_enderecos', function (Blueprint $table) {

            $table->increments('id')->unique();
            $table->integer('usuario_id');

            $table->string('complemento', 100)->nullable();
            $table->string('logradouro', 100);
            $table->string('municipio', 100);
            $table->string('numero', 10);
            $table->string('bairro', 40);
            $table->string('cep', 20);
            $table->string('uf', 2);

            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios_enderecos');
    }
};
