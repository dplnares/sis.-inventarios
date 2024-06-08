<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\ProductStorage;
use App\Models\Stock;

class StockFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Stock::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'product_id' => $this->faker->randomNumber(),
            'storage_id' => $this->faker->randomNumber(),
            'quantity' => $this->faker->randomNumber(),
            'status' => $this->faker->word(),
            'product_storage_id' => ProductStorage::factory(),
        ];
    }
}
