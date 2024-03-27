<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';
    public $timestamps = false;
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
    
    
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function subcategories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
}
