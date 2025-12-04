<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Mobile Legends',
                'slug' => 'mobile-legends',
                'icon' => 'https://cdn-game-photos.zeusx.com/ff770df4-a186-4d4b-a0d1-776d8bb02381.png',
                'description' => 'MOBA game paling populer di Indonesia',
            ],
            [
                'name' => 'PUBG Mobile',
                'slug' => 'pubg-mobile',
                'icon' => 'https://cdn-game-photos.zeusx.com/pubg-mobile-icon.png',
                'description' => 'Battle Royale game terpopuler',
            ],
            [
                'name' => 'Free Fire',
                'slug' => 'free-fire',
                'icon' => 'https://cdn-game-photos.zeusx.com/free-fire-icon.png',
                'description' => 'Battle Royale dengan gameplay cepat',
            ],
            [
                'name' => 'Genshin Impact',
                'slug' => 'genshin-impact',
                'icon' => 'https://cdn-game-photos.zeusx.com/genshin-icon.png',
                'description' => 'Open-world action RPG',
            ],
            [
                'name' => 'Honor of Kings',
                'slug' => 'honor-of-kings',
                'icon' => 'https://cdn-game-photos.zeusx.com/hok-icon.png',
                'description' => 'MOBA game dari Tencent',
            ],
            [
                'name' => 'Valorant',
                'slug' => 'valorant',
                'icon' => 'https://cdn-game-photos.zeusx.com/valorant-icon.png',
                'description' => 'Tactical FPS dari Riot Games',
            ],
            [
                'name' => 'Call of Duty Mobile',
                'slug' => 'call-of-duty-mobile',
                'icon' => 'https://cdn-game-photos.zeusx.com/codm-icon.png',
                'description' => 'FPS mobile dengan berbagai mode',
            ],
            [
                'name' => 'Arena of Valor',
                'slug' => 'arena-of-valor',
                'icon' => 'https://cdn-game-photos.zeusx.com/aov-icon.png',
                'description' => 'MOBA 5v5 dari Garena',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
