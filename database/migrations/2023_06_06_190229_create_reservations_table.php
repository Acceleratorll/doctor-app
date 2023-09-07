<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained();
            $table->foreignId('schedule_id')->constrained();
            $table->string('reservation_code');
            $table->boolean('bpjs')->default(0);
            $table->string('bukti_pembayaran')->nullable();
            $table->string('ktp')->nullable();
            $table->string('surat_rujukan')->nullable();
            $table->string('bpjs_card')->nullable();
            $table->integer('nomor_urut');
            $table->boolean('approve')->default(0);
            $table->boolean('status')->default(0);
            $table->softDeletes();
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
        Schema::dropIfExists('reservations');
    }
}
