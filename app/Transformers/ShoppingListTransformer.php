<?php

namespace App\Transformers;

use App\ShoppingList;
use League\Fractal\TransformerAbstract;

class ShoppingListTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(ShoppingList $shopping_list)
    {
        return [
            'id' => (int)$shopping_list->id,
            'name' => $shopping_list->name,
            'status' => $shopping_list->status,
            'creationDate' => (string)$shopping_list->created_at,
            'modifiedDate' => (string)$shopping_list->updated_at,
            'deletedDate' => isset($shopping_list->deleted_at) ? (string)$shopping_list->deleted_at : null,
        ];
    }
}
