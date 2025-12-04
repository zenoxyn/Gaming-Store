<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Seller;
use App\Models\Wallet;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin Account
        $admin = User::create([
            'username' => 'admin',
            'email' => 'admin@gamingstore.com',
            'password' => Hash::make('password'),
            'phone' => '081234567890',
            'role_user' => 'admin',
            'is_verified' => true,
        ]);

        Wallet::create([
            'id_user' => $admin->id,
            'balance' => 10000000, // 10 juta
        ]);

        // Seller Account (Verified)
        $seller1 = User::create([
            'username' => 'seller_pro',
            'email' => 'seller@example.com',
            'password' => Hash::make('password'),
            'phone' => '082345678901',
            'role_user' => 'seller',
            'is_verified' => true,
        ]);

        Wallet::create([
            'id_user' => $seller1->id,
            'balance' => 5000000, // 5 juta
        ]);

        Seller::create([
            'id_user' => $seller1->id,
            'legal_name' => 'John Doe',
            'id_card_number' => '3201234567890001',
            'id_card_photo' => 'ktp/seller1.jpg',
            'bank_name' => 'BCA',
            'bank_account_number' => '1234567890',
            'bank_account_name' => 'John Doe',
            'verification_status' => 'verified',
            'verified_at' => now(),
        ]);

        // Seller Account 2 (Verified)
        $seller2 = User::create([
            'username' => 'game_master',
            'email' => 'gamemaster@example.com',
            'password' => Hash::make('password'),
            'phone' => '083456789012',
            'role_user' => 'seller',
            'is_verified' => true,
        ]);

        Wallet::create([
            'id_user' => $seller2->id,
            'balance' => 3000000, // 3 juta
        ]);

        Seller::create([
            'id_user' => $seller2->id,
            'legal_name' => 'Jane Smith',
            'id_card_number' => '3201234567890002',
            'id_card_photo' => 'ktp/seller2.jpg',
            'bank_name' => 'Mandiri',
            'bank_account_number' => '0987654321',
            'bank_account_name' => 'Jane Smith',
            'verification_status' => 'verified',
            'verified_at' => now(),
        ]);

        // Buyer Accounts
        for ($i = 1; $i <= 5; $i++) {
            $buyer = User::create([
                'username' => "buyer{$i}",
                'email' => "buyer{$i}@example.com",
                'password' => Hash::make('password'),
                'phone' => "08445678901{$i}",
                'role_user' => 'buyer',
                'is_verified' => true,
            ]);

            Wallet::create([
                'id_user' => $buyer->id,
                'balance' => rand(100000, 2000000),
            ]);
        }
    }
}
