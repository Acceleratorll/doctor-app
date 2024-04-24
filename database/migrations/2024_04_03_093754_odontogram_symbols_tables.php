<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class OdontogramSymbolsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('odontogram_symbol', function (Blueprint $table) {
            $table->uuid('odontogram_id');
            $table->foreignId('symbol_id')->constrained();
            $table->timestamps();

            $table->foreign('odontogram_id')->references('id')->on('odontograms');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('odontogram_symbols');
    }
}
