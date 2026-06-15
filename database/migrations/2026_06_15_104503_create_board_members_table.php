<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('board_members', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('position', 255);
            $table->string('photo_url', 500)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('email', 255)->nullable();
            $table->tinyInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('board_members');
    }
};
