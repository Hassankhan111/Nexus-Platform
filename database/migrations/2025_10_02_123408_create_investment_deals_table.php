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
        Schema::create('investment_deals', function (Blueprint $table) {
            $table->id('deal_id');

            // Relations
            $table->foreignId('investor_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('startup_id')->constrained('startups')->cascadeOnDelete();

            // Deal details
            $table->decimal('amount', 12, 2)->nullable();    
            $table->decimal('equity', 5, 2)->nullable();   

            // Pipeline / status
            $table->enum('status', [
                'due_diligence',
                'term_sheet',
                'negotiation',
                'closed',
                'passed'
            ])->default('due_diligence');

            // Funding stage
            $table->enum('stage', [
                'pre_seed',
                'seed',
                'series_a',
                'series_b',
                'series_c',
                'ipo'
            ])->nullable();

            // Tracking
            $table->date('last_activity')->nullable();

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('investment_deals');
    }
};
