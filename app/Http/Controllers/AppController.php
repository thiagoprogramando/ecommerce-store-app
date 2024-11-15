<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Models\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppController extends Controller {
    
    public function app(Request $request) {

        $view = $this->createView($request->ip());

        $query = Product::orderBy('name', 'asc')->where('license', env('API_KEY'))->where('status', 1);

        if (!empty($request->name)) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if (!empty($request->category)) {
            $query->whereHas('categories', function($q) use ($request) {
                $q->where('categories.id', $request->category);
            });
        }

        return view('index', [
            'products'   => $query->get(),
            'banners'    => Banner::where('license', env('API_KEY'))->get(),
            'categories' => Category::where('license', env('API_KEY'))->orderBy('name', 'asc')->get()
        ]);
    }

    private function createView($ip) {

        $startOfDay = now()->startOfDay();
        $endOfDay = now()->endOfDay();

        $view = View::where('ip', $ip)->where('license', env('API_KEY'))
                ->whereBetween('created_at', [$startOfDay, $endOfDay])
                ->firstOrCreate(
                    ['ip' => $ip],
                    ['license' => env('API_KEY')]
                );

        return true;
    }
}
