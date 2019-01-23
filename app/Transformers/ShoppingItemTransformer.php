<?php

namespace App\Transformers;

use App\ShoppingItem;
use App\ShoppingList;
use League\Fractal\TransformerAbstract;

class ShoppingItemTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(ShoppingItem $shopping_item)
    {
        $shopping_list = ShoppingList::findOrFail($shopping_item->shopping_list_id);
        $user_id = $shopping_list->user_id;

        return [
            'item_id' => (int)$shopping_item->id,
            'qty' => $shopping_item->quantity,
            'price' => $shopping_item->price,
            'list_id' => (int)$shopping_item->shopping_list_id,
            'product_id' => (int)$shopping_item->product_id,
            'creationDate' => (string)$shopping_item->created_at,
            'modifiedDate' => (string)$shopping_item->updated_at,
            'deletedDate' => isset($shopping_item->deleted_at) ? (string)$shopping_item->deleted_at : null,

            'links' => [
                [
                    'rel' => 'self',
                    'href' => route('users.shoppings.items.show', [
                        'user_id' => $user_id, 
                        'shopping_list_id' => $shopping_item->shopping_list_id,
                        'item_id' => $shopping_item->id,
                        ]
                    ),
                ],
                'links' => [
                    [
                        'rel' => 'products',
                        'href' => route('products.show', $shopping_item->product_id),
                    ],
                ]
            ]
        ];
    }

    public static function originalAttribute($name)
    {
        $attributes = [
            'id' => 'item_id',
            'qty' => 'quantity',
            'price' => 'price',
            'list_id' => 'shopping_list_id',
            'product_id' => 'product_id',
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
            'quantity' => 'qty',
            'price' => 'price',
            'shopping_list_id' => 'list_id',
            'product_id' => 'product_id',
            'created_at' => 'creationDate',
            'updated_at' => 'modifiedDate',
            'deleted_at' => 'deletedDate',
        ];
        return isset($attributes[$name]) ? $attributes[$name] : null;
    }
}
