<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Discount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CouponController extends Controller {
    
    public function createDiscount(Request $request) {

        $coupon = Coupon::where('name', $request->name)->first();
        if($coupon) {

            $discount               = new Discount();
            $discount->customer_id  = Auth::user()->id;
            $discount->coupon_id    = $coupon->id;
            $discount->value        = $coupon->percentage;
            if($discount->save()) {
                return redirect()->back()->with('success', 'CUPOM adicionado!');
            }

            return redirect()->back()->with('error', 'Não foi possível adicionar COPOM!');
        }   

        return redirect()->back()->with('error', 'CUPOM inválido!');
    }

    public function removeDiscount(Request $request) {

        $discount = Discount::find($request->id);
        if($discount && $discount->delete()) {
            return redirect()->back()->with('success', 'CUPOM removido com sucesso!');
        }

        return redirect()->back()->with('error', 'Não foi possível remover o CUPOM!');
    }

}
