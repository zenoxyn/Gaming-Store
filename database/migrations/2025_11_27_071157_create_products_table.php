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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_seller')->constrained('sellers')->onDelete('cascade');
            $table->foreignId('id_category')->constrained('categories')->onDelete('cascade');
            $table->string('name_product', 100);
            $table->string('slug', 150)->unique();
            $table->enum('type_product', ['account', 'topup', 'ingame_item']);
            $table->text('description');
            $table->bigInteger('price');
            $table->bigInteger('discount_price')->nullable();
            $table->integer('stock')->default(1);
            $table->json('images')->nullable();
            $table->json('product_details')->nullable();
            $table->enum('status', ['available', 'sold', 'removed', 'out_of_stock'])->default('available');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
