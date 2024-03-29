<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FluxRss extends Model
{
    protected $table = 'fluxrss';
    protected $fillable = ['url', 'category_id'];
    public $timestamps = false;

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
