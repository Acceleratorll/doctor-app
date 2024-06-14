<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('place_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('employee_id')->constrained();
            $table->uuid('schedule_type_id');
            $table->date('schedule_date');
            $table->time('schedule_time');
            $table->time('schedule_time_end');
            $table->integer('qty');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('schedule_type_id')->references('id')->on('schedule_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedules');
    }
}
