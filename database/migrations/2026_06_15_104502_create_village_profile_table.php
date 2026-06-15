<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Single-row config table for village profile
        Schema::create('village_profile', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->default('Desa Sitiwinangun');
            $table->text('description')->nullable();
            $table->string('address', 500)->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->json('gallery_photos')->nullable(); // array of paths, max 6
            $table->timestamp('updated_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('village_profile');
    }
};
