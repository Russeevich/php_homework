<?php

use App\Models\Category;
use App\Models\Products;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

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
    $page = $_GET['page'] ?? 1;
    $data = [
        "products" => Products::skip(($page - 1) * 20)->
                          take(20)->
                          get(),
        "categories" => Category::get()
    ];

    return view('welcome', $data);
});

Route::get('/product/{id}', function($id){
    $product = Products::find($id);
    return view('product', [
        "product" => $product,
        "categories" => Category::get(),
        "randProd" => Products::inRandomOrder()->limit(4)->get(),
        "catName" => Category::find($product->category)->name
    ]);
});

Route::get('/category/{id}', function($id){
    $category = Category::find($id);
    if(!empty($category)){
        return view('category', [
            "cat" => $category,
            "products" => Products::where('category', $id)->get(),
            "categories" => Category::get()
        ]);
    }
    abort(404);
});

Route::post('/buy/{id}', [\App\Http\Controllers\buy::class, 'buy']);

Auth::routes();

Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::post('/home/updateCat/{id}', [\App\Http\Controllers\HomeController::class, 'updateCat']);

Auth::routes();

Route::post('/home/addCat', [\App\Http\Controllers\HomeController::class, 'addCat']);

Auth::routes();

Route::post('/home/updateProd/{id}', [\App\Http\Controllers\HomeController::class, 'updateProd']);

Auth::routes();

Route::post('/home/addProd', [\App\Http\Controllers\HomeController::class, 'addProd']);

Auth::routes();

Route::get('/home/deleteCat/{id}', [\App\Http\Controllers\HomeController::class, 'deleteCat']);

Auth::routes();

Route::get('/home/deleteProd/{id}', [\App\Http\Controllers\HomeController::class, 'deleteProd']);

Auth::routes();

Route::post('/home/changeMail', [\App\Http\Controllers\HomeController::class, 'changeMail']);
