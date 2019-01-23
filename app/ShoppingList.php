<?php

namespace App;

use App\ShoppingItem;
use Illuminate\Database\Eloquent\Model;
use App\Transformers\ShoppingListTransformer;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShoppingList extends Model
{
    use SoftDeletes;

    const PENDING = 'pending';
    const COMPLETED = 'completed';
    const DISCARDED = 'discarded';


    protected $fillable = [
        'name', 'status', 'user_id'
    ];

    protected $hidden = [
        'user_id'
    ];

    protected $dates = ['deleted_at'];

    public $transformer = ShoppingListTransformer::class;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(ShoppingItem::class);
    }
}
