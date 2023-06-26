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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('doctor_name');
            $table->string('doctor_specialty');
            $table->string('doctor_certificate_image');
            $table->string('doctor_phone');
            $table->string('doctor_password');
            $table->string('doctor_description');
            $table->string('doctor_ident');
            $table->string('doctor_license_number');
            $table->string('doctor_license_image');
            $table->string('address_clinc_doctor');
            $table->unsignedBigInteger('id_clinc');
            $table->timestamps();

            $table->foreign('id_clinc')->references('id')->on('clincs');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
