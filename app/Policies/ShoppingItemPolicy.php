<?php

namespace App\Policies;

use App\User;
use App\ShoppingItem;
use Illuminate\Auth\Access\HandlesAuthorization;

class ShoppingItemPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the shopping item.
     *
     * @param  \App\User  $user
     * @param  \App\ShoppingItem  $shoppingItem
     * @return mixed
     */
    public function view(User $user, ShoppingItem $shoppingItem)
    {
        return $user->id === $shoppingItem->shopping_lists->user_id;
    }

    /**
     * Determine whether the user can create shopping items.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->id === $shoppingItem->shopping_lists->user_id;
    }

    /**
     * Determine whether the user can update the shopping item.
     *
     * @param  \App\User  $user
     * @param  \App\ShoppingItem  $shoppingItem
     * @return mixed
     */
    public function update(User $user, ShoppingItem $shoppingItem)
    {
        return $user->id === $shoppingItem->shopping_lists->user_id;
    }

    /**
     * Determine whether the user can delete the shopping item.
     *
     * @param  \App\User  $user
     * @param  \App\ShoppingItem  $shoppingItem
     * @return mixed
     */
    public function delete(User $user, ShoppingItem $shoppingItem)
    {
        return $user->id === $shoppingItem->shopping_lists->user_id;
    }
}
