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
        Schema::create('negotiation_offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_negotiation')->constrained('negotiations')->onDelete('cascade');
            $table->foreignId('id_sender')->constrained('users')->onDelete('cascade');
            $table->bigInteger('offered_price');
            $table->text('notes')->nullable();
            $table->enum('status', ['pending', 'accepted', 'rejected', 'countered'])->default('pending');
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('negotiation_offers');
    }
};
