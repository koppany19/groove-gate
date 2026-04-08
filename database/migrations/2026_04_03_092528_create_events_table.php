<?php

use App\EventStatus;
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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organiser_profile_id')->constrained('organiser_profiles')->cascadeOnDelete();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('location');
            $table->dateTime('start_date');
            $table->dateTime('end_date')->nullable();
            $table->string('cover_image')->nullable();
            $table->unsignedInteger('capacity')->nullable();
            $table->boolean('has_seats')->default(false);
            $table->string('status')->default(EventStatus::DRAFT->value);
            $table->decimal('base_price', 10, 2)->nullable();
            $table->boolean('is_dynamic_price')->default(false);
            $table->timestamp('sale_end_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
