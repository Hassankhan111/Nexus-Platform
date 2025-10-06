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
        Schema::create('meetings', function (Blueprint $table) {
           $table->id('meeting_id');
            $table->foreignId('investor_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('entrepreneur_id')->constrained('users')->onDelete('cascade');
            $table->timestamp('scheduled_at');
            $table->enum('status', ['scheduled', 'completed', 'canceled'])->default('scheduled');
            $table->string('meeting_link')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meetings');
    }
};
