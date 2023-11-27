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
            $table->decimal('amount', 5, 2);
            $table->decimal('bill', 5 ,2);
            $table->decimal('balance', 5 ,2);
            $table->dateTime('dateOfPayment');
            $table->unsignedBigInteger('studentId');
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
