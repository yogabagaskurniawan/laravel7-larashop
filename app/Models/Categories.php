<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categories extends Model
{
    protected $fillable = ['name','slug','parent_id']; 

    // relasi dengan tabel itu sendiri untuk membuat multi level kategori
    public function child()
    {
        return $this->hasMany('App\Models\Categories', 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo('App\Models\Categories', 'parent_id');
    }

    // relasi dari tabel categories ke tabel products
    public function products()
    {
        return $this->belongsToMany('App\Models\Product', 'product_categories');
    }

    public function scopeParentCategories($query)
    {
        return $query->where('parent_id', 0);
    }
}
