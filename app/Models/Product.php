<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array

     */
    protected $fillable = [
        'category_id',
        'name',
        'sku',
        'slug',
        'details',
        'price',
        'description',
        'featured',
        'image',
        'images',
        'quantity'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
