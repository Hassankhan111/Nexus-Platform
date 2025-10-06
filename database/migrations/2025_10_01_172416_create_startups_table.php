<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('startups', function (Blueprint $table) {
            $table->id('startup_id');
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('startup_name')->nullable();
            $table->string('company_name')->nullable();
            $table->string('location')->nullable();
            $table->string('industry_name')->nullable();
            $table->year('founded_year')->nullable();
            $table->integer('team_size')->nullable();
            $table->decimal('funding_need', 12, 2)->nullable();
            $table->text('pitch_summary')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });

    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('startups');
    }
};
