<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\Seller;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mlCategory = Category::where('slug', 'mobile-legends')->first();
        $pubgCategory = Category::where('slug', 'pubg-mobile')->first();
        $ffCategory = Category::where('slug', 'free-fire')->first();

        $seller1 = Seller::first();
        $seller2 = Seller::skip(1)->first();

        // Mobile Legends Products
        if ($mlCategory && $seller1) {
            Product::create([
                'id_seller' => $seller1->id,
                'id_category' => $mlCategory->id,
                'name_product' => 'Akun Mobile Legends Mythic 200+ Hero',
                'type_product' => 'account',
                'description' => 'Akun ML tier Mythic dengan 200+ hero, 50+ skin epic/legend. Server Indonesia. Email bisa diganti.',
                'price' => 2500000,
                'discount_price' => 2000000,
                'stock' => 1,
                'images' => json_encode([
                    'https://example.com/ml-account-1.jpg',
                    'https://example.com/ml-account-2.jpg',
                ]),
                'product_details' => json_encode([
                    'rank' => 'Mythic',
                    'total_heroes' => 200,
                    'total_skins' => 50,
                    'server' => 'Indonesia',
                    'win_rate' => '60%',
                ]),
                'status' => 'available',
            ]);

            Product::create([
                'id_seller' => $seller1->id,
                'id_category' => $mlCategory->id,
                'name_product' => 'Top Up 100 Diamond Mobile Legends',
                'type_product' => 'topup',
                'description' => 'Top up diamond ML legal, proses cepat 1-5 menit. Garansi 100%.',
                'price' => 25000,
                'stock' => 999,
                'images' => json_encode(['https://example.com/ml-diamond.jpg']),
                'product_details' => json_encode([
                    'amount' => '100 Diamond',
                    'process_time' => '1-5 menit',
                    'guarantee' => 'Yes',
                ]),
                'status' => 'available',
            ]);

            Product::create([
                'id_seller' => $seller2->id,
                'id_category' => $mlCategory->id,
                'name_product' => 'Skin Fanny Skylark',
                'type_product' => 'ingame_item',
                'description' => 'Skin epic Fanny limited edition. Rare item!',
                'price' => 150000,
                'stock' => 3,
                'images' => json_encode(['https://example.com/fanny-skylark.jpg']),
                'product_details' => json_encode([
                    'hero' => 'Fanny',
                    'rarity' => 'Epic',
                    'type' => 'Limited Edition',
                ]),
                'status' => 'available',
            ]);
        }

        // PUBG Mobile Products
        if ($pubgCategory && $seller1) {
            Product::create([
                'id_seller' => $seller1->id,
                'id_category' => $pubgCategory->id,
                'name_product' => 'Akun PUBG Mobile Conqueror S20',
                'type_product' => 'account',
                'description' => 'Akun PUBG tier Conqueror season 20, banyak skin legendary, full set M4 Glacier.',
                'price' => 3500000,
                'discount_price' => 3000000,
                'stock' => 1,
                'images' => json_encode([
                    'https://example.com/pubg-conqueror.jpg',
                ]),
                'product_details' => json_encode([
                    'rank' => 'Conqueror',
                    'season' => 'S20',
                    'kd_ratio' => '4.5',
                    'special_items' => 'M4 Glacier, AWM Dragon',
                ]),
                'status' => 'available',
            ]);

            Product::create([
                'id_seller' => $seller2->id,
                'id_category' => $pubgCategory->id,
                'name_product' => 'Top Up 600 UC PUBG Mobile',
                'type_product' => 'topup',
                'description' => 'Top up UC PUBG legal dan aman, proses instant.',
                'price' => 80000,
                'stock' => 999,
                'images' => json_encode(['https://example.com/pubg-uc.jpg']),
                'product_details' => json_encode([
                    'amount' => '600 UC',
                    'process_time' => 'Instant',
                ]),
                'status' => 'available',
            ]);
        }

        // Free Fire Products
        if ($ffCategory && $seller2) {
            Product::create([
                'id_seller' => $seller2->id,
                'id_category' => $ffCategory->id,
                'name_product' => 'Akun Free Fire Heroic Tier',
                'type_product' => 'account',
                'description' => 'Akun FF Heroic tier dengan banyak bundle dan skin rare.',
                'price' => 1200000,
                'stock' => 2,
                'images' => json_encode(['https://example.com/ff-heroic.jpg']),
                'product_details' => json_encode([
                    'rank' => 'Heroic',
                    'level' => '65',
                    'bundles' => '25+',
                ]),
                'status' => 'available',
            ]);

            Product::create([
                'id_seller' => $seller2->id,
                'id_category' => $ffCategory->id,
                'name_product' => 'Top Up 100 Diamond Free Fire',
                'type_product' => 'topup',
                'description' => 'Top up diamond FF termurah dan terpercaya.',
                'price' => 12000,
                'stock' => 999,
                'images' => json_encode(['https://example.com/ff-diamond.jpg']),
                'product_details' => json_encode([
                    'amount' => '100 Diamond',
                    'bonus' => '+10 Diamond',
                ]),
                'status' => 'available',
            ]);
        }
    }
}
