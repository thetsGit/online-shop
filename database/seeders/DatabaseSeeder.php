<?php

namespace Database\Seeders;

use App\Models\Admin;
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
        Admin::create([
            'name' => 'DaddyHan',
            'email'=>'hanthet@gmail.com',
            'password'=>Hash::make('password'),
            'image'=>'admin.jpeg'
        ]);
    }
}
