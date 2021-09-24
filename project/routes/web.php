<?php

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
    $data = [];
    $data["products"] = DB::table('products')->
                          skip(($page - 1) * 20)->
                          take(20)->
                          get();

    return view('welcome', $data);
});

Route::get('/product/{id}', function($id){
    $product = DB::table('products')->find($id);
    return view('product', [
        "product" => $product
    ]);
});

Route::get('/category/{id}', function($id){
    $category = DB::table('category')->find($id);
    if(!empty($category)){
        return view('category', [
            "cat" => $category,
            "products" => DB::table('products')->where('category', $id)->get()
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
