<?php

namespace Database\Factories;

use Faker\Provider\Base;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class AnnouncementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
         return [
             'title'=>$this->faker->text(10),
             'image'=>$this->faker->image(),
             'reserved'=>$this->faker->boolean(),
             'body'=>$this->faker->text(10)
         ];

    }
}
