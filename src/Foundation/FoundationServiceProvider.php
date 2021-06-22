<?php

namespace Macrame\Foundation;

use Macrame\Support\FileResponse;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class FoundationServiceProvider extends ServiceProvider
{
    /**
     * Register application services.
     *
     * @return void
     */
    public function register()
    {
        $this->callAfterResolving('router', function (Router $router) {
            $router->get('admin/js/app.js', fn () => new FileResponse(__DIR__.'/../../dist/react/app.js'));
        });
    }
}
