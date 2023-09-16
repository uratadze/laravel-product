<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public array $data = [
        [
            'name' => 'product 1',
            'price' => 20,
            'quantity' => 50
        ],
        [
            'name' => 'product 2',
            'price' => 5,
            'quantity' => 10
        ],
        [
            'name' => 'product 3',
            'price' => 100,
            'quantity' => 2
        ],
        [
            'name' => 'product 4',
            'price' => 57,
            'quantity' => 1000
        ],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->data as $datum)
        {
            Product::query()->updateOrCreate($datum);
        }
    }
}
