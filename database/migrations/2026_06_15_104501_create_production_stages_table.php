<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('production_stages', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('stage_number')->unsigned(); // 1–5
            $table->string('title', 255);
            $table->longText('description');
            $table->string('photo_url', 500)->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('production_stages');
    }
};
