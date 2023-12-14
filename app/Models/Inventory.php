<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $table = 'inventory';

    /**
     * The attributes that are mass assignable.
     *
     * @var array

     */
    protected $fillable = [
        'product_id',
        'quantity',
        'description',
    ];
}
