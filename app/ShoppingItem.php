<?php

namespace App;

use App\Product;
use App\ShoppingList;
use Illuminate\Database\Eloquent\Model;
use App\Transformers\ShoppingItemTransformer;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShoppingItem extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'quantity', 'price', 'product_id', 'shopping_list_id'
    ];

    protected $dates = ['deleted_at'];

    public $transformer = ShoppingItemTransformer::class;

    public function shopping_list() {
        return $this->belongsTo(ShoppingList::class);
    }

    public function product() {
        return $this->hasOne(Product::class);
    }
}
