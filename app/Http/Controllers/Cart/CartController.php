<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Discount;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller {

    public function cart() {

        return view('Cart.cart', [
            'itens'         => Cart::where('customer_id', Auth::user()->id)->whereNull('payment_token')->get(),
            'discounts'     => Discount::where('customer_id', Auth::user()->id)->whereNull('payment_token')->get(),
            'valueProduct'  => Cart::where('customer_id', Auth::user()->id)->where('status', 0)->whereNull('payment_token')->sum('value'),
        ]);
    }
    
    public function addCart(Request $request) {

        $product = Product::find($request->product_id);
        if(($product->stock !== null && $product->stock < 1) || $product->status != 1) {
            return redirect()->back()->with('error', 'Produto indisponível no momento!');
        }

        if(($product->stock < $request->qtd) && $product->stock != null) {
            return redirect()->back()->with('error', 'Quantidade excede o estoque!');
        }

        $cart = new Cart();
        $cart->name         = $request->name;
        $cart->qtd          = max(1, $request->qtd);
        $cart->value        = ($request->value * max(1, $request->qtd));
        $cart->customer_id  = Auth::user()->id;
        $cart->product_id   = $request->product_id;
        $cart->license      = env('API_KEY');
        if($cart->save()) {
            return redirect()->route('cart')->with('success', 'Produto adicionado com sucesso!');
        }

        return redirect()->back()->with('error', 'Não foi possível adicionar o produto!');
    }

    public function removeCart(Request $request) {

        $cart = Cart::find($request->id);
        if($cart && $cart->delete()) {
            return redirect()->back()->with('success', 'Produto removido com sucesso!');
        }

        return redirect()->back()->with('error', 'Não foi possível remover o Produto!');
    }
}
