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
        Schema::create('investor_startups', function (Blueprint $table) {
            $table->id('investors_id');
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('inv_name')->nullable();
            $table->string('company')->nullable();
            $table->string('inv_location')->nullable();
            $table->string('inv_industry')->nullable();
            $table->year('year')->nullable();
            $table->integer('inv_teamsize')->nullable();
            $table->decimal('funding_ned', 12, 2)->nullable();
            $table->text('pitch_summ')->nullable();
            $table->string('inv_image')->nullable();
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('investor_startups');
    }
};
