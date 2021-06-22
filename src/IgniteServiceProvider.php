<?php

namespace Macrame;

use Illuminate\Support\ServiceProvider;
use Macrame\Foundation\FoundationServiceProvider;
use Macrame\Ui\UiServiceProvider;

class MacrameServiceProvider extends ServiceProvider
{
    /**
     * Register application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(UiServiceProvider::class);
        $this->app->register(FoundationServiceProvider::class);
    }
}
