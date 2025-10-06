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
     Schema::create('connections', function (Blueprint $table) {
    $table->id('connection_id');
    $table->foreignId('investor_id')->constrained('users')->cascadeOnDelete();
    $table->foreignId('startup_id')->constrained('startups')->cascadeOnDelete();
    $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('connection');
    }
};
