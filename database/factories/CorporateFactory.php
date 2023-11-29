<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use Faker\Provider\Base;

class CorporateFactory extends Factory
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
            'email'=>$this->faker->email(),
            'password'=>$this->faker->password(),
            'agency_id'=>Base::randomElement(DB::table('agencies')->pluck('id')),
            'role'=>$this->faker->randomNumber(1)
        ];
    }
}
