<?php

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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(App\Models\User::class, 'sender_id')->constrained('users');
            $table->foreignIdFor(App\Models\User::class, 'recipient_id')->constrained('users');
            $table->foreignIdFor(App\Models\Project::class, 'project_id')->constrained();
            $table->text('content');
            $table->enum('status', ['read', 'unread'])->default('unread');
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
