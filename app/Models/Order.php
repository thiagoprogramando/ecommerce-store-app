<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model {
    
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'customer_id',
        'name',
        'value',
        'coupon_id',
        'status',
        'payment_method',
        'payment_installments',
        'payment_token',
        'payment_url',
        'tracking_code',
        'license'
    ];

    public function labelStatus(): string {
        $status = [
            0 => 'Pendente',
            1 => 'Confirmado',
            2 => 'Pagamento Aprovado',
            3 => 'Pedido Enviado',
            4 => 'Pedido Cancelado'
        ];

        return $status[$this->status] ?? 'Pendente';
    }

    public function discounts() {
        return $this->hasMany(Discount::class, 'token_pay', 'payment_token');
    }

    public function carts() {
        return $this->hasMany(Cart::class, 'token_pay', 'payment_token');
    }
}
