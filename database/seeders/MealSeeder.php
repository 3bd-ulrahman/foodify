<?php

namespace Database\Seeders;

use App\Models\Meal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MealSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        Meal::factory(30)->create();
    }
}
