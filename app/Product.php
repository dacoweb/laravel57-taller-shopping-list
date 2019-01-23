<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Transformers\ProductTransformer;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'name', 'description',
    ];

    protected $dates = ['deleted_at'];

    public $transformer = ProductTransformer::class;
}
