<?php

namespace App\Transformers;

use App\ShoppingItem;
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
        return [
            'id' => (int)$shopping_item->id,
            'qty' => $shopping_item->quantity,
            'price' => $shopping_item->price,
            'list_id' => (int)$shopping_item->shopping_list_id,
            'product_id' => (int)$shopping_item->product_id,
            'creationDate' => (string)$shopping_item->created_at,
            'modifiedDate' => (string)$shopping_item->updated_at,
            'deletedDate' => isset($shopping_item->deleted_at) ? (string)$shopping_item->deleted_at : null,
        ];
    }
}
