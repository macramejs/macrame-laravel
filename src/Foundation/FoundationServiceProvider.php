<?php

namespace Macrame\Foundation;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Macrame\Support\FileResponse;

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
