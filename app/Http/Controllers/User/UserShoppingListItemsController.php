<?php

namespace App\Http\Controllers\User;

use App\User;
use App\ShoppingItem;
use App\ShoppingList;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Transformers\ShoppingItemTransformer;

class UserShoppingListItemsController extends ApiController
{

    public function __construct()
    {
        $this->middleware('client.credentials')->only(['index', 'show']);
        $this->middleware('auth:api')->except(['index', 'show']);
        $this->middleware('transform.api.inputs:' . ShoppingItemTransformer::class)->only(['store', 'update']);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\ShoppingList $shopping
     * @return \Illuminate\Http\Response
     */
    public function index(User $user, ShoppingList $shopping)
    {
        return $this->showAll($shopping->items);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ShoppingList $shopping
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user, ShoppingList $shopping)
    {
        $rules = [
            'product_id' => 'required|numeric',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric',
        ];

        $this->validate($request, $rules);

        $data = $request->all();

        $data['shopping_list_id'] = $shopping->id;

        $item = ShoppingItem::create($data);

        return $this->showOne($item, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, ShoppingList $shopping, ShoppingItem $item)
    {
        return $this->showOne($item);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user, ShoppingList $shopping, ShoppingItem $item)
    {
        $item->fill($request->only(['quantity', 'price', 'product_id']));

        if ($item->isClean()) {
            return $this->errorResponse("You need specify a different value to update.", 422);
        }

        // Verify if provided product id already exist.
        if (!ShoppingItem::where('id', $item->product_id)->first()) {
            return $this->errorResponse("Product specify doesn't exist, please verify.", 404);
        }

        $item->save();

        return $this->showOne($item);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, ShoppingList $shopping, ShoppingItem $item)
    {
        $item->delete();

        return $this->showOne($item);
    }
}
