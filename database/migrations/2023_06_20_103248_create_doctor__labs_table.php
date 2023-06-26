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
        Schema::create('doctor_labs', function (Blueprint $table) {
            $table->id();
            $table->string('doctor_lab_name');
            $table->string('doctor_lab_specialty');
            $table->string('doctor_lab_certificate_image');
            $table->string('doctor_lab_phone');
            $table->string('doctor_lab_password');
            $table->string('doctor_lab_ident');
            $table->unsignedBigInteger('id_lab');

            $table->foreign('id_lab')->references('id')->on('labs');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctor_labs');
    }
};
