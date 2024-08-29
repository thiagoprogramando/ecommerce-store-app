<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ImageProduct;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller {
    
    public function shop(Request $request) {

        $query = Product::where('license', env('API_KEY'))
                        ->where(function ($query) {
                            $query->whereNull('stock')
                                ->orWhere('stock', '>', 0);
                        })
                        ->orderBy('name', 'asc');

        if (!empty($request->search)) {
            $query->where('name', 'like', '%' . $request->search . '%')->orWhere('description', 'like', '%' . $request->search . '%');
        }

        if (!empty($request->max_value)) {
            $query->where('value', '<=', $request->max_value);
        }

        if (!empty($request->min_value)) {
            $query->where('value', '>=', $request->min_value);
        }

        if (!empty($request->ean)) {
            $query->where('ean', $request->ean);
        }

        if (!empty($request->size)) {
            $query->where('size', $request->size);
        }

        if (!empty($request->unit)) {
            $query->where('unit', $request->unit);
        }

        if (!empty($request->type)) {
            $query->where('type', $request->type);
        }

        if (!empty($request->category)) {
            $query->whereHas('categories', function($q) use ($request) {
                $q->where('categories.id', $request->category);
            });
        }

        return view('Shop.shop', [
            'products'   => $query->paginate(30),
            'categories' => Category::where('license', env('API_KEY'))->orderBy('name', 'asc')->get()
        ]);
    }

    public function product($id) {


        $product = product::find($id);
        if($product) {
            
            $product->views += 1;
            $product->save();
            
            return view('Shop.product', [
                'product' => $product,
                'images'  => ImageProduct::where('product_id', $product->id)->get()
            ]);
        }

        return redirect()->back()->with('error', 'Produto não disponível!');
    }

}
