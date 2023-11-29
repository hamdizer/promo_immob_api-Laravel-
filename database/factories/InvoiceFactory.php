<?php

namespace Database\Factories;

use Faker\Provider\Base;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
             'name'=>$this->faker->text(20),
        'send_date'=>$this->faker->date($format = 'Y-m-d'),
       'limit_date'=>$this->faker->date($format = 'Y-m-d'),
        'payed'=>$this->faker->boolean(),
        'bill_amount'=>$this->faker->randomNumber(3),
          'agency_id'=>Base::randomElement(DB::table('agencies')->pluck('id')),
            'client_id'=>Base::randomElement(DB::table('clients')->pluck('id')),
        ];
    }
}
