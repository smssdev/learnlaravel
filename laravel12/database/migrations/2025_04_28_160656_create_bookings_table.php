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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->uuid('flight_id'); // Foreign key for flight
            $table->foreign('flight_id') // Define the foreign key relationship
            ->references('flight_id') // Reference to 'flight_id' in the 'my_flights' table
            ->on('my_flights') // The 'my_flights' table
            ->onDelete('cascade'); // If the flight is deleted, also delete the booking
            $table->string('name');
            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
