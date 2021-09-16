<?php

namespace Database\Factories;

use App\Models\Quotation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuotationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Quotation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'customer_first_name' => $this->faker->firstName(),
            'customer_last_name' => $this->faker->lastName(),
            'customer_email' => $this->faker->safeEmail(),
            'customer_city' => $this->faker->city(),
            'customer_street' => $this->faker->streetName(),
            'customer_postal_code' => $this->faker->postcode(),
            'customer_house_number' => $this->faker->numberBetween(1, 100),
            'status' => 'In progress',
        ];
    }
}
