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
        Schema::create('ordem_de_servico', function (Blueprint $table) {
            $table->id();
            $table->string('cliente');
            $table->string('carro');
            $table->string('peca');
            $table->string('tenant_id');
            $table->string('valor_servico');
            $table->string('descricao_servico');
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
        Schema::dropIfExists('ordem_de_servico');
    }
};
