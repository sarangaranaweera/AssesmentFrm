<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * Get the posts for the product.
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
