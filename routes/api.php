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

// App endpoint
Route::resource('products', 'Product\ProductController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);

// Users endpoints
Route::resource('users', 'User\UserController', ['only' => ['index', 'show']]);
Route::name('verify')->get('users/verify/{token}', 'User\UserControllerVerify@verify');

Route::resource('users.shoppings', 'User\UserShoppingListController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);
Route::resource('users.shoppings.items', 'User\UserShoppingListItemsController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);
