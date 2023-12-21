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
        Schema::create('fees', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('amount');
            $table->bigInteger('balance')->nullable();
            $table->string('date_of_payment');
            $table->string('term');
            $table->string('bill_type');
            $table->bigInteger('academic_year');
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
        Schema::dropIfExists('fees');
    }
};
