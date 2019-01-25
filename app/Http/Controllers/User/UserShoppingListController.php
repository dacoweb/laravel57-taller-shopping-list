<?php

namespace App\Http\Controllers\User;

use App\User;
use App\ShoppingList;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Transformers\ShoppingListTransformer;

class UserShoppingListController extends ApiController
{
    public function __construct()
    {
        $this->middleware('client.credentials')->only(['index', 'show']);
        $this->middleware('auth:api')->except(['index', 'show']);
        $this->middleware('can:view,shoppingList')->only('show');
        $this->middleware('transform.api.inputs:' . ShoppingListTransformer::class)->only(['store', 'update']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        return $this->showAll($user->shopping_list);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        $rules = [
            'name' => 'required',
        ];

        $this->validate($request, $rules);

        $data = $request->all();
        $data['user_id'] = $user->id;
        $data['status'] = ShoppingList::PENDING;

        $shopping_list = ShoppingList::create($data);

        return $this->showOne($shopping_list, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @param  \App\ShoppingList $shopping
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, ShoppingList $shopping)
    {
        return $this->showOne($shopping);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @param  \App\ShoppingList $shopping
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user, ShoppingList $shopping)
    {
        if (!$user->shopping_list->contains($shopping)) {
            return $this->errorResponse("Specified shopping list doesn't exist.", 404);
        }

        $shopping->fill($request->only(['name', 'status']));

        if ($shopping->isClean()) {
            return $this->errorResponse("No changes applied.", 422);
        }

        $shopping->save();

        return $this->showOne($shopping);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @param  \App\ShoppingList $shopping
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, ShoppingList $shopping)
    {
        $shopping->delete();

        return $this->showOne($shopping);
    }
}
