<?php

namespace Database\Factories;

use Faker\Provider\Base;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class RequestAgencyAccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'send_date'=>$this->faker->date($format = 'Y-m-d'),
            'state'=>$this->faker->randomNumber(1),
            'agency_id'=>Base::randomElement(DB::table('agencies')->pluck('id')),
            'admin_id'=>Base::randomElement(DB::table('administrators')->pluck('id')),
        ];
    }
}
