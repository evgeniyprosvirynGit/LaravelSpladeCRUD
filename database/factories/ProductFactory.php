<?php

namespace Database\Factories;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $uniqId = uniqid();

        return [
            'field_name_value' => Str::random(10),
            'field_okdp_value' => Str::upper(Str::random(2)). '-'. $uniqId,
            'field_price_value' => fake()->randomFloat(2, 0, 10000),
            'field_alias_value' => $uniqId,
            'visibility' => rand(0, 1),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }

    public function insertFields()
    {
       return [
            'field_name_value',
            'field_okdp_value',
            'field_price_value',
            'field_alias_value',
            'visibility',
            'created_at',
            'updated_at',
        ];
    }
}
