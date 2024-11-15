<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageProduct extends Model {
    
    use HasFactory;

    protected $table = 'image_product';

    protected $fillable = [
        'product_id',
        'file'
    ];

    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
