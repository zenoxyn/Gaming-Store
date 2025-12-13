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
        Schema::create('coin_flip_games', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_negotiation')->constrained('negotiations')->onDelete('cascade');
            $table->foreignId('id_buyer')->constrained('users')->onDelete('cascade');
            $table->foreignId('id_seller')->constrained('users')->onDelete('cascade');
            $table->bigInteger('dp_amount')->comment('50% of price difference');
            $table->boolean('buyer_dp_paid')->default(false);
            $table->enum('buyer_call', ['heads', 'tails'])->nullable();
            $table->enum('result', ['heads', 'tails', 'pending'])->default('pending');
            $table->enum('winner', ['buyer', 'seller'])->nullable();
            $table->bigInteger('final_price')->nullable();
            $table->timestamp('payment_deadline')->nullable();
            $table->boolean('buyer_paid')->default(false);
            $table->boolean('penalty_distributed')->default(false);
            $table->enum('game_status', ['waiting_dp', 'playing', 'finished', 'canceled'])->default('waiting_dp');
            $table->timestamp('played_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coin_flip_games');
    }
};
