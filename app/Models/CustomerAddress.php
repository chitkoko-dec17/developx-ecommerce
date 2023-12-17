<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerAddress extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array

     */
    protected $fillable = [
        'customer_id',
        'address_type',
        'company_name',
        'address',
        'apartment',
        'city',
        'state',
        'postal_code',
        'country',
        'phone',
    ];
}
