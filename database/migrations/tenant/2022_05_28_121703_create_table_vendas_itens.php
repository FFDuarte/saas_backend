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
        Schema::create('vendas_itens', function (Blueprint $table) {
            $table->id()->unique();

            $table->integer('venda_id');

            $table->string('codigo', 6);
            $table->text('descricao');
            $table->text('und')->nullable();

            $table->text('observacoes')->nullable();

            $table->text('foto_orig')->nullable();
            $table->text('foto_red')->nullable();
            $table->text('foto_small')->nullable();

            $table->decimal('qtd', 15, 4)->default(1);

            $table->decimal('valor_custo_unitario', 15, 4)->nullable()->default(0);
            $table->decimal('valor_custo_total', 15, 4)->nullable()->default(0);

            $table->decimal('valor_desconto_unitario', 15, 4)->nullable()->default(0);
            $table->decimal('valor_desconto_total', 15, 4)->nullable()->default(0);

            $table->decimal('valor_unitario', 15, 4);
            $table->decimal('valor_total', 15, 4);


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
        Schema::dropIfExists('vendas_itens');
    }
};
