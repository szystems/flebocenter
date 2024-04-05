<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    use HasFactory;

    protected $table = 'configs';
    protected $fillable = [
        'logo',
        'time_zone',
        'currency',
        'currency_simbol',
        'tax_status',
        'tax',
        'paypal',
        'dbt',
        'shipping_description',
        'email',
        'contract',
        'registration_process',
        'payments_description',
        'fb_link',
        'inst_link',
        'yt_link',
        'wapp_link',
    ];
}
