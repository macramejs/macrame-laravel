<?php

namespace Macrame;

use Illuminate\Support\ServiceProvider;
use Macrame\Console\ConsoleServiceProvider;

class MacrameServiceProvider extends ServiceProvider
{
    /**
     * Register application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(ConsoleServiceProvider::class);
    }
}
