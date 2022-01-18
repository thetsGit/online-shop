<?php

namespace Database\Seeders;

use App\Models\AgeGroup;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductOrder;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Thethan',
            'email'=>'eagleking495@gmail.com',
            'password'=>Hash::make('password'),
            'image'=>'user.jpg',
            'role'=>'user'
        ]);
        User::create([
            'name' => 'Thirihan',
            'email'=>'hyacinchhh@gmail.com',
            'password'=>Hash::make('password'),
            'image'=>'user.jpg',
            'role'=>'user'
        ]);
        User::create([
            'name' => 'admin',
            'email'=>'admin@gmail.com',
            'password'=>Hash::make('password'),
            'image'=>'user.jpg',
            'role'=>'admin'
        ]);
        AgeGroup::factory(5)->create();
        Category::factory(5)->create();
        Product::factory(15)->create();
        ProductOrder::factory(25)->create();
    }
}
