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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_product')->constrained('products')->onDelete('cascade');
            $table->foreignId('id_buyer')->constrained('users')->onDelete('cascade');
            $table->foreignId('id_seller')->constrained('users')->onDelete('cascade');
            $table->integer('quantity')->default(1);
            $table->bigInteger('original_price');
            $table->bigInteger('final_price');
            $table->bigInteger('platform_fee')->default(0);
            $table->enum('payment_method', ['wallet', 'bank_transfer', 'ewallet'])->default('wallet');
            $table->enum('payment_status', ['pending', 'paid', 'escrow_locked', 'released', 'refunded'])->default('pending');
            $table->enum('order_status', ['pending', 'processing', 'delivered', 'completed', 'canceled', 'dispute'])->default('pending');
            $table->text('delivery_info')->nullable();
            $table->text('buyer_notes')->nullable();
            $table->text('seller_notes')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamp('canceled_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
