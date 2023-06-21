<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categories extends Model
{
    protected $fillable = ['name','slug','parent_id']; 

    public function child()
    {
        return $this->hasMany('App\Models\Categories', 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo('App\Models\Categories', 'parent_id');
    }
}
