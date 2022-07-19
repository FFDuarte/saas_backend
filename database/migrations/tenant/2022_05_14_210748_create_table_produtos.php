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
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->integer('codigo');
            $table->string('descricao');
            $table->integer('und_saida')->default(0);
            $table->decimal('qtd',15,2);
            $table->decimal('preco_custo',15,2);
            $table->decimal('preco_venda',15,2);
            $table->string('categoria');
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
