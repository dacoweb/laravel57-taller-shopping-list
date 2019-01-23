<?php

namespace App\Transformers;

use App\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'id' => (int)$user->id,
            'name' => $user->name,
            'email' => $user->email,
            'isAdmin' => (int)$user->admin,
            'creationDate' => (string)$user->created_at,
            'modifiedDate' => (string)$user->updated_at,

            'links' => [
                [
                    'rel' => 'self',
                    'href' => route('users.show', $user->id),
                ],
                [
                    'rel' => 'users.shoppings',
                    'href' => route('users.shoppings.index', $user->id),
                ],
            ]
        ];
    }

    public static function originalAttribute($name)
    {
        $attributes = [
            'id' => 'id',
            'name' => 'name',
            'email' => 'email',
            'isAdmin' => 'admin',
            'creationDate' => 'created_at',
            'modifiedDate' => 'updated_at',
        ];
        return isset($attributes[$name]) ? $attributes[$name] : null;
    }

    public static function transformedAttribute($name)
    {
        $attributes = [
            'id' => 'id',
            'name' => 'name',
            'email' => 'email',
            'admin' => 'isAdmin',
            'created_at' => 'creationDate',
            'updated_at' => 'modifiedDate',
        ];
        return isset($attributes[$name]) ? $attributes[$name] : null;
    }
}
