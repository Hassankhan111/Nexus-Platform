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
    Schema::create('profiles', function (Blueprint $table) {
    $table->id('profile_id'); // primary key, no nullable
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->text('bio')->nullable();
    $table->text('startup_history')->nullable();
    $table->integer('investment_history')->nullable();
    $table->text('preferences')->nullable();
    $table->string('image')->nullable();
    $table->text('location')->nullable();
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
