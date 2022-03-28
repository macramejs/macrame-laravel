<?php

namespace Macrame\Console;

use Illuminate\Console\GeneratorCommand;

class MakeIndexCommand extends GeneratorCommand
{
    use Concerns\HasAppOption;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:index';

    /**
     * The name of the console command.
     *
     * This name is used to identify the command during lazy loading.
     *
     * @var string|null
     */
    protected static $defaultName = 'make:index';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Index';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new index class';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/stubs/index.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Http\Indexes';
    }
}
