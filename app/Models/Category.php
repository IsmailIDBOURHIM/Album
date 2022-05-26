<?php

namespace App\Models;

use App\Events\CategorySaving;
use Illuminate\Database\Eloquent\Model;
use App\Models\Image;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
    ];

    protected $dispatchesEvents = [
        'saving' => CategorySaving::class
    ];

    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
