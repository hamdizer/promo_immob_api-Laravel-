<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'cin' => $this->faker->randomNumber(8),
            'last_name' => $this->faker->lastName(),
            'first_name'=>$this->faker->firstName(),
            'phone_number'=>$this->faker->randomNumber(8),
            'address'=>$this->faker->address(),
            'email'=>$this->faker->email(),
            'password'=>$this->faker->password(),
        ];
    }
}
