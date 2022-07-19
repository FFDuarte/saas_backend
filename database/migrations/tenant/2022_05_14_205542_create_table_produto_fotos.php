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
        Schema::create('produtos_fotos', function (Blueprint $table) {
            $table->id();
            $table->integer('id_produto');
            $table->boolean('principal')->default(false);
            $table->text('foto_small')->nullable();
            $table->text('foto_red')->nullable();
            $table->text('foto_orig')->nullable();
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
        Schema::dropIfExists('produtos_fotos');
    }
};
