<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class GenerateProductSlugs extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::whereNull('slug')
            ->orWhere('slug', '')
            ->get();

        foreach ($products as $product) {
            $slug = Str::slug($product->name_product);
            $count = 1;
            $originalSlug = $slug;

            while (Product::where('slug', $slug)->where('id', '!=', $product->id)->exists()) {
                $slug = $originalSlug . '-' . $count++;
            }

            $product->slug = $slug;
            $product->save();

            $this->command->info("Generated slug for product #{$product->id}: {$slug}");
        }

        $this->command->info('All product slugs have been generated!');
    }
}
