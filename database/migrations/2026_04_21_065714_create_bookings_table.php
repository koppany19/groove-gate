<?php

use App\BookingStatus;
use App\Models\Booking;
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
            $table->foreignId('event_id')->constrained('events')->cascadeOnDelete();
            $table->foreignId('artist_profile_id')->constrained('artist_profiles')->cascadeOnDelete();
            $table->decimal('fee', 10, 2)->nullable();
            $table->string('message')->nullable();
            $table->string('status')->default(BookingStatus::PENDING->value);
            $table->timestamps();

            $table->unique(['event_id', 'artist_profile_id']);
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
