<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ { User, Category };

class Image extends Model
{
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function scopeLatestWithUser($query)
    {
        return $query->with('user')->latest();
    }
}
