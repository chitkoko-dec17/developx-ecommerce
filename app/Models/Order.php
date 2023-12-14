<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array

     */
    protected $fillable = [
        'customer_id',
        'billing_email',
        'billing_first_name',
        'billing_last_name',
        'billing_company_name',
        'billing_address',
        'billing_address_2',
        'billing_city',
        'billing_province',
        'billing_postalcode',
        'billing_phone',
        'billing_name_on_card',
        'billing_subtotal',
        'billing_tax',
        'billing_total',
        'shipping_email',
        'shipping_first_name',
        'shipping_last_name',
        'shipping_company_name',
        'shipping_address',
        'shipping_address_2',
        'shipping_city',
        'shipping_province',
        'shipping_postalcode',
        'shipping_phone',
        'payment_gateway',
        'shipped',
        'error',
        'order_status',
        'tracking_code',
        'order_note',
    ];
}
