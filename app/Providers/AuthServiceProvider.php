<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        'App\Http\Models\Channel'=>'App\Policies\ChannelPolicy',
        'App\Http\Models\Video'=>'App\Policies\VideoPolicy',
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
