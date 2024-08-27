<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model {
    
    use HasFactory;

    protected $table = 'discount';

    protected $fillable = [
        'customer_id',
        'coupon_id',
        'value',
        'payment_token',
        'status'
    ];

    public function coupon() {
        return $this->belongsTo(Coupon::class, 'coupon_id');
    }
}
