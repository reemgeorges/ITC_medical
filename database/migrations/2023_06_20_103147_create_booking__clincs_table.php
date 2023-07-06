<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('booking_clincs', function (Blueprint $table) {
           $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('use_name');
            $table->string('user_old');
            $table->string('user_phone');
            $table->tinyInteger('user_gender')->default(0)->comment('0=>man;1=>woman');
            $table->tinyInteger('booking_status')->default(0);
            $table->datetime('booking_datetime')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->date('booking_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->unsignedInteger('doctor_id');
            $table->tinyInteger('review_booking')->default(0)->comment('0->not, 1->yes');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_clincs');
    }
};
