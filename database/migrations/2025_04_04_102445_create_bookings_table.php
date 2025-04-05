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
            $table->unsignedBigInteger('user_id')->index(); 
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('event_id')->index(); 
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
            //$table->foreignId('event_id')->constrained()->onDelete('cascade');
            $table->integer('number_of_tickets')->nullable();
            $table->integer('total_price')->nullable();
            $table->string('booking_reference')->nullable();
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
