<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('empresa')->nullable(false);
            $table->string('cnpf_cnpj')->nullable(false);
            $table->string('fantasia')->nullable(false);
            $table->string('logradouro')->nullable(false);
            $table->string('numero')->nullable(false);
            $table->string('bairro')->nullable(false);
            $table->string('cidade')->nullable(false);
            $table->string('uf')->nullable(false);
            $table->string('cep')->nullable(false);
            $table->string('complemento')->nullable();
            $table->string('observacoes')->nullable();
            $table->string('telefone1')->nullable();
            $table->string('telefone2')->nullable();
            $table->string('telefone3')->nullable();
            $table->json('data')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('tenants');
    }
}
