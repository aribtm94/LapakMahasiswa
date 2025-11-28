<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SellerSeeder extends Seeder
{
    public function run(): void
    {
        // Beberapa penjual contoh yang sudah terverifikasi
        $sellers = [
            [
                'name'           => 'Seller Audio',
                'email'          => 'seller1@lapak.test',
                'shop_name'      => 'Lapak Audio Kampus',
                'password'       => 'password',
            ],
            [
                'name'           => 'Seller Peripheral',
                'email'          => 'seller2@lapak.test',
                'shop_name'      => 'Lapak Peripheral Kampus',
                'password'       => 'password',
            ],
            [
                'name'           => 'Seller Print',
                'email'          => 'seller3@lapak.test',
                'shop_name'      => 'Print Center Teknik',
                'password'       => 'password',
            ],
        ];

        foreach ($sellers as $data) {
            User::updateOrCreate(
                ['email' => $data['email']],
                [
                    'name'             => $data['name'],
                    'shop_name'        => $data['shop_name'],
                    'password'         => Hash::make($data['password']),
                    'email_verified_at'=> now(),
                    'seller_status'    => 'approved',
                    'is_admin'         => false,
                ]
            );
        }
    }
}
