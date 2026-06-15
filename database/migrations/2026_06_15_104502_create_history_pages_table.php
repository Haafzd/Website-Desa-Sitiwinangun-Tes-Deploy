<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('history_pages', function (Blueprint $table) {
            $table->id();
            $table->string('page_key', 100)->unique(); // e.g. 'desa_history', 'gerabah_history'
            $table->string('title', 255);
            $table->longText('content');
            $table->timestamp('updated_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('history_pages');
    }
};
