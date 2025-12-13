<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('slug', 150)->unique()->nullable()->after('name_product');
        });

        // Generate slugs for existing products
        $products = DB::table('products')->get();
        foreach ($products as $product) {
            $slug = Str::slug($product->name_product);
            $count = 1;
            $originalSlug = $slug;

            while (DB::table('products')->where('slug', $slug)->where('id', '!=', $product->id)->exists()) {
                $slug = $originalSlug . '-' . $count++;
            }

            DB::table('products')->where('id', $product->id)->update(['slug' => $slug]);
        }

        // Make slug non-nullable after data is populated
        Schema::table('products', function (Blueprint $table) {
            $table->string('slug', 150)->unique()->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
