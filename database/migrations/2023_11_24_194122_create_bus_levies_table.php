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
        Schema::create('bus_levies', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('amount');
            $table->bigInteger('bill');
            $table->bigInteger('balance')->nullable();
            $table->dateTime('dateOfPayment');
            $table->unsignedBigInteger('student_id');
            // Foreign key relationship
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bus_levies');
    }
};
