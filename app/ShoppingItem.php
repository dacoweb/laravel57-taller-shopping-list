<?php

namespace App;

use App\Product;
use App\ShoppingList;
use Illuminate\Database\Eloquent\Model;

class ShoppingItem extends Model
{
    public function shopping_list() {
        return $this->belongsTo(ShoppingList::class);
    }

    public function product() {
        return $this->hasOne(Product::class);
    }
}
