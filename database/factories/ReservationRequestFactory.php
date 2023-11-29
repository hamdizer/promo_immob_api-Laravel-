<?php

namespace Database\Factories;

use Faker\Provider\Base;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class ReservationRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
        'date'=>$this->faker->date($format = 'Y-m-d'),
        'state'=>$this->faker->randomNumber(1),
        'accepted_by'=>Base::randomElement(DB::table('corporates')->pluck('id'))   ,
        'announcement_id'=>Base::randomElement(DB::table('announcements')->pluck('id')),
        'client_id'=>Base::randomElement(DB::table('clients')->pluck('id'))
        ];
    }
}
