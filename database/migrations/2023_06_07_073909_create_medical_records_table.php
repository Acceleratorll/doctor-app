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
            $table->string('action');
            $table->string('complaint');
            $table->string('physical_exam');
            $table->string('diagnosis');
            $table->string('recommendation');
            $table->string('recipe');
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
