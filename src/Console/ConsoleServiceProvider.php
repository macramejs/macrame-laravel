<?php

namespace Macrame\Console;

use Illuminate\Support\ServiceProvider;

class ConsoleServiceProvider extends ServiceProvider
{
    /**
     * The commands to be registered.
     *
     * @var array
     */
    protected $commands = [
        'MakeIndex' => MakeIndexCommand::class,
    ];

    /**
     * Register application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerCommands($this->commands);
    }

    /**
     * Register the given commands.
     *
     * @param  array $commands
     * @return void
     */
    protected function registerCommands(array $commands)
    {
        foreach (array_keys($commands) as $command) {
            $this->{"register{$command}Command"}();
        }

        $this->commands(array_values($commands));
    }

    /**
     * Regsiter make:admin command.
     *
     * @return void
     */
    protected function registerMakeIndexCommand()
    {
        $this->app->singleton(MakeIndexCommand::class, function ($app) {
            return new MakeIndexCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerControllerMakeCommand()
    {
        $this->app->extend('command.controller.make', function ($cmd, $app) {
            return new ControllerMakeCommand($app['files']);
        });
    }
}
