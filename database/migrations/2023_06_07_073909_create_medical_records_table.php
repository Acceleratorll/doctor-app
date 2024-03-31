<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalRecordsTable extends Migration
{
    public function up()
    {
        Schema::create('medical_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reservation_id')->constrained();
            $table->string('icd_code')->nullable();
            $table->string('action')->nullable();
            $table->string('complaint')->nullable();
            $table->string('physical_exam')->nullable();
            $table->string('diagnosis')->nullable();
            $table->string('recommendation')->nullable();
            $table->string('recipe')->nullable();
            $table->enum('occlusi', ['normal'], ['cross'], ['steep'])->nullable();
            $table->enum('torus_palatinus', ['none'], ['kecil'], ['sedang'], ['besar'], ['multiple'])->nullable();
            $table->enum('torus_mandibularis', ['none'], ['sisi_kiri'], ['sisi_kanan'], ['kedua_sisi'])->nullable();
            $table->enum('palatum', ['dalam'], ['sedang'], ['rendah'])->nullable();
            $table->string('desc')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('icd_code')->references('code')->on('icds');
        });
    }

    public function down()
    {
        Schema::dropIfExists('medical_records');
    }
}
