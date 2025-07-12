<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('disable_schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('holiday_schedule_id')->nullable();
            $table->foreign('holiday_schedule_id')->references('id')->on('services');
            $table->unsignedBigInteger('booking_schedule_id')->nullable();
            $table->foreign('booking_schedule_id')->references('id')->on('booking_schedules');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disable_schedules');
    }
};
