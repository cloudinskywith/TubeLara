<?php

namespace App\Providers;

use App\Http\ViewComposer\NavigationComposer;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        view()->composer('layouts.partials._navigation',NavigationComposer::class);
    }
    public function register()
    {
    }
}
