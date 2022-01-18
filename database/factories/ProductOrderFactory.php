<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductOrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $statusArr = ['pending','complete'];
        return [
            'user_id'=>User::all()->random()->id,
            'product_id'=>Product::all()->random()->id,
            'quantity'=>rand(1,10),
            'status'=>$statusArr[array_rand($statusArr,1)],
        ];
    }
}
