<?php

namespace Database\Seeders;

use App\Models\Cart;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CartSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        Cart::factory(5)->create();
    }
}
