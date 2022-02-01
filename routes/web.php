<?php

use App\Models\Product;
use App\Models\ProductCart;
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

// Route::get("/get-path",function(){
//     return public_path("image");
// });

// _____________________________________________user________________________________________________________
Route::group(["middleware"=>"shareData"],function(){
    Route::get('/', "PageController@index");

    // user authentication
    Route::get("/signin","PageController@signinShow");
    Route::post("/signin","PageController@signinStore");
    Route::get("/register","PageController@registerShow");
    Route::post("/register","PageController@registerStore");
    Route::get("/signout","PageController@signout");

    // products searching routes
    Route::get("/products","ProductController@index");
    Route::get("/products/ageGroup/{slug}","ProductController@ageGroupShow");
    Route::get("/products/category/{slug}","ProductController@categoryShow");

    //restricted user routes
    Route::group(["middleware"=>"userAuth"],function(){
        Route::get("/products/{slug}","PageController@productDetail");//product details
        Route::post("/toggleLike","DataController@toggleLike");//like remove or add
        Route::post("/toggleFavourite","DataController@toggleFavourite");//favourite remove or add
        Route::post("/createComment","CommentController@create");//create comment
        Route::post("/removeComment","CommentController@remove");//remove comment
        Route::get("/cart","CartController@showAll");//view cart
        Route::post("/cart/add","CartController@addOne");//add to cart
        Route::post("/cart/remove","CartController@removeOne");//remove from cart
        Route::get("/profile","PageController@profile");//view profile
        Route::post("/uploadImage","PageController@UploadProfileImage");
        Route::get("/makeOrder","OrderController@makeOrder");//make order
        Route::get("/favourites","PageController@showFavourites");//show favourites
    });
});



// ____________________________________admin___________________________________________
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
