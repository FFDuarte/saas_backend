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
        Schema::create('vendas', function (Blueprint $table) {

            $table->increments('id')->unique();
            $table->integer('usuario_id');
            $table->string('tenant_id');

            $table->string('observacoes', 100)->nullable();

            $table->text('entrega_id');
            $table->text('forma_pagamento');
            $table->integer('forma_pagamento_id');

            $table->text('cupom_id')->nullable();
            $table->decimal('cupom_desconto_valor', 15, 4)->nullable()->default(0);

            $table->text('status')->nullable();

            $table->decimal('valor_total_produtos', 15, 4)->nullable()->default(0);
            $table->decimal('valor_total_descontos', 15, 4)->nullable()->default(0);
            $table->decimal('valor_total_pedido', 15, 4)->nullable()->default(0);

            $table->dateTime('data_hora_faturamento')->nullable();
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
        Schema::dropIfExists('vendas');
    }
};
