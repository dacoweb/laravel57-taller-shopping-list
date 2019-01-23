<?php

namespace App\Transformers;

use App\Product;
use League\Fractal\TransformerAbstract;

class ProductTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Product $product)
    {
        return [
            'id' => (int)$product->id,
            'product' => $product->name,
            'description' => $product->description,
            'creationDate' => (string)$product->created_at,
            'modifiedDate' => (string)$product->updated_at,
            'deletedDate' => isset($product->deleted_at) ? (string)$product->deleted_at : null,

            'links' => [
                [
                    'rel' => 'self',
                    'href' => route('products.show', $product->id),
                ],
            ]
        ];
    }

    public static function originalAttribute($name)
    {
        $attributes = [
            'id' => 'id',
            'product' => 'name',
            'description' => 'description',
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
            'name' => 'product',
            'description' => 'description',
            'created_at' => 'creationDate',
            'updated_at' => 'modifiedDate',
            'deleted_at' => 'deletedDate',
        ];
        return isset($attributes[$name]) ? $attributes[$name] : null;
    }
}
