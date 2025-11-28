<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // Seed default admin user
        $this->call([
            AdminUserSeeder::class,
            SellerSeeder::class,
        ]);

        // Produk contoh (rating & reviews awal 0)
        Product::create([
            'user_id'        => 1,
            'name'           => 'Mic Shure WB98 H/C',
            'description'    => "Mic clip condenser dengan kualitas suara jernih.\nCocok untuk kebutuhan vocal & instrumen di lingkungan kampus.",
            'shop_name'      => 'Lapak Audio Kampus',
            'condition'      => 'baru',
            'min_order'      => 1,
            'showcase'       => 'MICROPHONE CABLE',
            'price'          => 2999999,
            'average_rating' => 0,
            'reviews_count'  => 0,
            'sold_count'     => 10,
            'stock'          => 6,
        ]);

        Product::create([
            'user_id'        => 1,
            'name'           => 'Keyboard Mechanical RK84',
            'description'    => "Keyboard mechanical wireless untuk produktivitas dan gaming.\nHot-swappable, RGB backlight, cocok untuk setup mahasiswa.",
            'shop_name'      => 'Lapak Peripheral Kampus',
            'condition'      => 'baru',
            'min_order'      => 1,
            'showcase'       => 'KEYBOARD & MOUSE',
            'price'          => 850000,
            'average_rating' => 0,
            'reviews_count'  => 0,
            'sold_count'     => 23,
            'stock'          => 12,
        ]);

        Product::create([
            'user_id'        => 1,
            'name'           => 'Paket Print Skripsi A4',
            'description'    => "Jasa print dan jilid skripsi kualitas premium.\nBisa kirim file online, ambil di kampus.",
            'shop_name'      => 'Print Center Teknik',
            'condition'      => 'baru',
            'min_order'      => 1,
            'showcase'       => 'JASA & PRINTING',
            'price'          => 75000,
            'average_rating' => 0,
            'reviews_count'  => 0,
            'sold_count'     => 40,
            'stock'          => 100,
        ]);
    }
}
