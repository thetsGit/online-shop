<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AgeGroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'slug'=>uniqid(time()),
            'name'=>$this->faker->name()
        ];
    }
}
