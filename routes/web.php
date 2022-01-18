<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Product::all();
});

// admin authentication
Route::get("/admin/login","Admin\PageController@loginShow");
Route::post("/admin/login","Admin\PageController@loginCheck");
Route::get("/admin/logout","Admin\PageController@logout");


// dashboard routes
Route::group(['middleware'=>"adminAuth",'prefix'=>'admin','namespace'=>'Admin','as'=>'admin.'],function(){
    Route::get('/','PageController@index');
    Route::group(['prefix'=>'orders'],function(){
      Route::get('/pending','OrderController@pending');
      Route::get('/complete','OrderController@complete');
      Route::put('/makeComplete/{order}','OrderController@makeComplete');
    });
    Route::resource('/categories','CategoryController');
    Route::resource('/ageGroups','AgeGroupController');
    Route::resource('/users','UserController');
    Route::resource('/products','ProductController');
    Route::resource('/profile','ProfileController');
    Route::get('/','HomeController@index');
});
