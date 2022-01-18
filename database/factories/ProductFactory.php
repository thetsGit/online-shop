<?php

namespace Database\Factories;

use App\Models\AgeGroup;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category_id'=>Category::all()->random()->id,
            'slug'=>uniqid(time()),
            'name'=>$this->faker->name(),
            'image'=>'product.jpg',
            'age_group_id'=>AgeGroup::all()->random()->id,
            'description'=>$this->faker->text(),
            'price'=>50,
            'view_count'=>10
        ];
    }
}
