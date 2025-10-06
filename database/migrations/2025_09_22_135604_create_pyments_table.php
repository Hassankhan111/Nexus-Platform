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
        Schema::create('pyments', function (Blueprint $table) {
            $table->id('payment_id');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('amount', 10, 2)->nullable();
            $table->string('currency', 10)->default('USD')->nullable();
            $table->enum('status', ['pending', 'completed', 'failed'])->nullable();
            $table->string('payment_method')->nullable(); // e.g., Stripe, PayPal
            $table->string('transaction_id')->nullable();
            $table->enum('stage', ['Seed', 'Series A', 'Series B', 'Series C'])->nullable();
           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pyments');
    }
};
