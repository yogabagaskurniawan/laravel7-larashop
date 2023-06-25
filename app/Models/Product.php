<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'sku',
        'slug',
        'price',
        'weight',
        'length',
        'width',
        'height',
        'short_description',
        'description',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    // public function categories()
    // {
    //     return $this->belongsToMany('App\Models\Categories', 'product_categories');
    // }

    public function categories()
    {
        return $this->belongsToMany(Categories::class, 'product_categories', 'product_id', 'category_id');
    }


    public static function statuses()
    {
        return [
            0 => 'draft',
            1 => 'active',
            2 => 'inactive',
        ];
    }
}
