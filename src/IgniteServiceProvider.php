<?php

namespace Macrame;

use Macrame\Foundation\FoundationServiceProvider;
use Macrame\Ui\UiServiceProvider;
use Macrame\Ui\Vue\Vue;
use Illuminate\Routing\Route;
use Illuminate\Support\ServiceProvider;

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
