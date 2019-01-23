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
}