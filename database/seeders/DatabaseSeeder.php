<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(['email' => 'djibril@menma.com'], [
            'name' => 'Djibril',
            'password' => Hash::make('djil45ll'),
        ]);

        $settings = [
            ['key' => 'hero_title', 'value' => 'LIVRAISON GRATUITE'],
            ['key' => 'hero_subtitle', 'value' => 'Commandez sur WhatsApp • Payez à la livraison'],
            ['key' => 'shop_name', 'value' => 'Menma Shop'],
            ['key' => 'whatsapp_number', 'value' => '224625968097'],
            ['key' => 'admin_app_name', 'value' => 'Menma Shop Admin'],
            ['key' => 'admin_theme_color', 'value' => '#1a1a1a'],
        ];

        foreach ($settings as $s) {
            Setting::updateOrCreate(['key' => $s['key']], ['value' => $s['value']]);
        }

        Product::updateOrCreate(['nom' => 'iPhone 15 Pro Max'], [
            'prix' => 12000000,
            'stock' => 5,
            'description' => 'Le dernier iPhone 15 Pro Max avec processeur A17 Pro.',
            'image_url' => 'https://m.media-amazon.com/images/I/81SigAnN7KL._AC_SL1500_.jpg',
        ]);

        Product::updateOrCreate(['nom' => 'Samsung Galaxy S24 Ultra'], [
            'prix' => 11500000,
            'stock' => 3,
            'description' => 'Smartphone ultra puissant avec IA intégrée et stylet S Pen.',
            'image_url' => 'https://m.media-amazon.com/images/I/71RZA9L94tL._AC_SL1500_.jpg',
        ]);
    }
}
