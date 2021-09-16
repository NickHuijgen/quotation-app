<?php

namespace Database\Factories;

use App\Models\Quotation;
use App\Models\QuotationLine;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuotationLineFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = QuotationLine::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'quotation_id' => Quotation::factory(),
            'description' => $this->faker->word(),
            'price' => $this->faker->numberBetween(1, 2000),
            'amount' => $this->faker->numberBetween(1, 50),
        ];
    }
}
