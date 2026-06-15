<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('virtual_tour', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->text('description')->nullable();
            $table->enum('embed_type', ['pannellum', 'marzipano', 'iframe', 'custom_html'])->default('pannellum');
            $table->mediumText('embed_code');
            $table->mediumText('sanitized_code')->nullable();
            $table->boolean('is_active')->default(false);
            $table->json('version_history')->nullable(); // max 5 versions
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('virtual_tour');
    }
};
