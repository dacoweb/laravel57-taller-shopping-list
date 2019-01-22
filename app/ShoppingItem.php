<?php

namespace App;

use App\Product;
use App\ShoppingList;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShoppingItem extends Model
{
    use SoftDeletes;
    
    protected $dates = ['deleted_at'];

    public function shopping_list() {
        return $this->belongsTo(ShoppingList::class);
    }

    public function product() {
        return $this->hasOne(Product::class);
    }
}
