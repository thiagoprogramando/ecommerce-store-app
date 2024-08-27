<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model {
    
    use HasFactory;

    protected $table = 'cart';

    protected $fillable = [
        'customer_id',
        'product_id',
        'name',
        'value',
        'qtd',
        'payment_token',
        'status',
        'license'
    ];

    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
