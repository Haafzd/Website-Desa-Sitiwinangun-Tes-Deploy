<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('action', 100);
            $table->string('target_type', 100)->nullable();
            $table->unsignedBigInteger('target_id')->nullable();
            $table->longText('old_value')->nullable(); // JSON snapshot
            $table->longText('new_value')->nullable(); // JSON snapshot
            $table->string('ip_address', 45)->nullable();
            $table->timestamp('created_at')->useCurrent();
            // No updated_at — audit logs are immutable
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};
