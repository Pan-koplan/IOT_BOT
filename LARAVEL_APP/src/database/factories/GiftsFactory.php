<?php

namespace Database\Factories;

use App\Models\gifts;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\gifts>
 */
class GiftsFactory extends Factory
{
    /**
     * Определите модель, для которой создается эта фабрика.
     *
     * @var string
     */
    protected $model = gifts::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name
        ];
    }
}
