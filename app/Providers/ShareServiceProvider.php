<?php

namespace App\Providers;

use App\Models\Link;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class ShareServiceProvider extends ServiceProvider {

    public function register(): void {
        
    }

    public function boot(): void {
        View::composer('*', function ($view) {
            
            $link = Link::where('license', env('API_KEY'))->first();
            $view->with('link', $link);
        }); 
    }
}
