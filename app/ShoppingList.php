<?php

namespace App;

use App\ShoppingItem;
use Illuminate\Database\Eloquent\Model;

class ShoppingList extends Model
{
    const PENDING = 'pending';
    const COMPLETED = 'completed';
    const DISCARDED = 'discarded';

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function items() {
        return $this->hasMany(ShoppingItem::class);
    }
}
