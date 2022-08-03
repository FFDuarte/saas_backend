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
        Schema::create('associados', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('nome_artistico');
            $table->date('data_nascimento');
            $table->string('cnpf_cnpj');
            $table->string('rua')->nullable();
            $table->string('numero')->nullable();
            $table->string('cep')->nullable();
            $table->string('cidade')->nullable();
            
            $table->string('uf')->nullable();
            $table->string('pais')->nullable();
            $table->string('email')->nullable();
            $table->string('email2')->nullable();
            $table->string('telefone1');
            $table->string('telefone2')->nullable();
            $table->string('data_cobranca');
            $table->string('tenant_id');
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
        Schema::dropIfExists('produtos');
    }
};
