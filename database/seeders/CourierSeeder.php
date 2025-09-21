<?php

namespace Database\Seeders;

use App\Models\Courier;
use Illuminate\Database\Seeder;

class CourierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Courier::create([
            'name' => 'Fikri',
            'email' => 'fikri@sato.com',
            'password' => bcrypt('fikri123'),
        ]);
    }
}
