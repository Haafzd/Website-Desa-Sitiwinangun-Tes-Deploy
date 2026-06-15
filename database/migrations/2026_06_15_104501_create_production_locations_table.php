<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('production_locations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('artisan_id')->nullable()->constrained('artisans')->nullOnDelete();
            $table->string('name', 255);
            $table->string('address', 500);
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
            $table->string('phone', 20)->nullable();
            $table->text('main_products')->nullable();
            $table->string('visit_capacity', 100)->nullable();
            $table->text('edu_activities')->nullable();
            $table->boolean('is_open_visit')->default(true);
            $table->string('photo_url', 500)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('production_locations');
    }
};
