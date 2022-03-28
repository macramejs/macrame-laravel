<?php

namespace Macrame;

use Illuminate\Support\ServiceProvider;
use Macrame\Foundation\FoundationServiceProvider;

class MacrameServiceProvider extends ServiceProvider
{
    /**
     * Register application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(FoundationServiceProvider::class);
    }
}
