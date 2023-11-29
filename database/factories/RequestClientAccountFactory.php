<?php

namespace Database\Factories;

use Faker\Provider\Base;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class RequestClientAccountFactory extends Factory
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
        'admin_id'=>Base::randomElement(DB::table('announcements')->pluck('id')),
            'client_id'=>Base::randomElement(DB::table('clients')->pluck('id')),

        ];
    }
}
