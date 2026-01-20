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
            $table->id('pyment_id');

            // Foreign key to users table
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->string('stripe_payment_id')->nullable(); // Stripe payment ID
            $table->integer('amount'); // Amount in cents
            $table->string('currency')->default('usd');
            $table->string('status')->default('pending'); // pending, succeeded, failed
            $table->text('description')->nullable();

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
