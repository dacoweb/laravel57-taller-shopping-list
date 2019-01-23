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
            'isAdmin' => (boolean)$user->isAdmin(),
            'creationDate' => (string)$user->created_at,
            'modifiedDate' => (string)$user->updated_at,
        ];
    }
}