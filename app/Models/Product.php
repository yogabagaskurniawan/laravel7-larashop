<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'parent_id',
        'user_id',
        'name',
        'sku',
        'type',
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

    // relasi dari product ke productInventory 
    // hasone karna satu product satu data di productInventory
    public function productInventory()
    {
        return $this->hasOne('App\Models\ProductInventory');
    }

    public function categories()
    {
        return $this->belongsToMany(Categories::class, 'product_categories', 'product_id', 'category_id');
    }

    // relasi dengan tabel itu sendiri 
    public function variants()
    {
        return $this->hasMany('App\Models\Product', 'parent_id')->orderBy('price', 'ASC');
    }

    public function parent()
    {
        return $this->BelongsTo('App\Models\Product', 'parent_id');
    }

    public function productAttributeValues()
    {
        return $this->hasMany('App\Models\ProductAttributeValue', 'parent_product_id');
    }

    public static function statuses()
    {
        return [
            0 => 'draft',
            1 => 'active',
            2 => 'inactive',
        ];
    }

    // function status_label(){
    //     $statuses = $this->statuses();
    //     return isset($this->status) ? $statuses[$this->status] : null;
    // }

    // relasi ke tabel product_images
    public function productImages()
    {
        return $this->hasMany('App\Models\productImage')->orderBy('id', 'DESC');
    }

    public static function types()
    {
        return [
            'simple' => 'Simple',
            'configurable' => 'Configurable'
        ];
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active')->where('parent_id', NULL)->orderBy('created_at', 'DESC');
    }

    function price_label()
    {
        return ($this->variants->count() > 0) ? $this->variants->first()->price : $this->price;
    }
}
