<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::resource('products', 'Product\ProductController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);

Route::resource('users', 'User\UserController', ['only' => ['index', 'show']]);
Route::resource('users.shoppings', 'User\UserShoppingListController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);

Route::resource('items', 'ShoppingItem\ShoppingItemController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);