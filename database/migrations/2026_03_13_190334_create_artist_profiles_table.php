<?php

use App\ArtistTypeEnum;
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
        Schema::create('artist_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('stage_name')->nullable();
            $table->text('bio')->nullable();
            $table->json('genre')->nullable();
            $table->string('genre_other')->nullable();
            $table->string('artist_type')->default(ArtistTypeEnum::LIVE->value);
            $table->unsignedInteger('price_min')->nullable();
            $table->unsignedInteger('price_max')->nullable();
            $table->unsignedInteger('duration')->nullable();
            $table->string('location')->nullable();
            $table->string('profile_image')->nullable();
            $table->boolean('is_available')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artist_profiles');
    }
};
