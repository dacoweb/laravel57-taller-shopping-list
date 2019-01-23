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

            'links' => [
                [
                    'rel' => 'self',
                    'href' => route('users.shoppings.show', [
                        'user_id' => $shopping_list->user_id, 
                        'id' => $shopping_list->id
                        ]
                    ),
                ],
                [
                    'rel' => 'users.shoppings.items',
                    'href' => route('users.shoppings.items.index', [
                        'user_id' => $shopping_list->user_id, 
                        'id' => $shopping_list->id
                        ]
                    ),
                ],
            ]
        ];
    }

    public static function originalAttribute($name)
    {
        $attributes = [
            'id' => 'id',
            'name' => 'name',
            'status' => 'status',
            'creationDate' => 'created_at',
            'modifiedDate' => 'updated_at',
            'deletedDate' => 'deleted_at',
        ];
        return isset($attributes[$name]) ? $attributes[$name] : null;
    }

    public static function transformedAttribute($name)
    {
        $attributes = [
            'id' => 'id',
            'name' => 'name',
            'status' => 'status',
            'created_at' => 'creationDate',
            'updated_at' => 'modifiedDate',
            'deleted_at' => 'deletedDate',
        ];
        return isset($attributes[$name]) ? $attributes[$name] : null;
    }
}
