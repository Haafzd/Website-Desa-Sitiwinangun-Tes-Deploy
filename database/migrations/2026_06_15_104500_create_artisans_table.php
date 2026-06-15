<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('artisans', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('photo_url', 500)->nullable();
            $table->string('years_active', 50)->nullable();
            $table->string('specialty', 255)->nullable();
            $table->longText('story')->nullable();
            $table->text('quote')->nullable();
            $table->string('address', 255);
            $table->string('phone', 20)->nullable();
            $table->boolean('is_featured')->default(false);
            $table->tinyInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('artisans');
    }
};
