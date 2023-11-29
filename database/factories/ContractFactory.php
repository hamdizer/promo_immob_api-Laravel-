<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Provider\Base;
use Illuminate\Support\Facades\DB;

class ContractFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->text(10),
            'send_date'=>$this->faker->date($format = 'Y-m-d'),
            'period'=>$this->faker->randomNumber(2),
            'bill_amount'=>$this->faker->randomNumber(6),
            'agency_id'=>Base::randomElement(DB::table('agencies')->pluck('id')),
            'client_id'=>Base::randomElement(DB::table('clients')->pluck('id'))



        ];
    }
}
