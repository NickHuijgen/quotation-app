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


            $contents = [
                App\Models\Product::class,
                App\Models\Hour::class,
            ];
//            $contentsType = $this->faker->randomElement($contents);
//            $contents = factory($contentsType)->create();

        return [
            'contents_type' => $this->faker->randomElement($contents),
            'contents_id' => $this->faker->numberBetween(1,10),
            'quotation_id' => $this->faker->numberBetween(1,10),
            'amount' => $this->faker->numberBetween(1, 50),
        ];
    }
}
