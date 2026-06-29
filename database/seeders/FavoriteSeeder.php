<?php

namespace Database\Seeders;

use App\Models\Favorite;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FavoriteSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        Favorite::factory(20)->create();
    }
}
