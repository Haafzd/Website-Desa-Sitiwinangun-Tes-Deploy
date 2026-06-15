<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('collections', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('slug', 255)->unique();
            $table->foreignId('category_id')->constrained('categories')->restrictOnDelete();
            $table->string('photo_url', 500);
            $table->text('description'); // ≤500 chars
            $table->longText('history_origin');
            $table->longText('philosophy')->nullable();
            $table->longText('technique');
            $table->text('materials');
            $table->foreignId('artisan_id')->constrained('artisans')->restrictOnDelete();
            $table->string('location', 255);
            $table->smallInteger('year')->unsigned();
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('collections');
    }
};
