<?php

namespace Macrame\Console\Concerns;

use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;

trait HasAppOption
{
    /**
     * Get the root namespace for the class.
     *
     * @return string
     */
    protected function rootNamespace()
    {
        if ($app = $this->option('app')) {
            return ucfirst($app).'\\';
        }

        return parent::rootNamespace();
    }

    /**
     * Get the destination class path.
     *
     * @param  string  $name
     * @return string
     */
    protected function getPath($name)
    {
        if ($app = $this->option('app')) {
            $name = Str::replaceFirst($this->rootNamespace(), '', $name);

            return base_path($app.'/'.str_replace('\\', '/', $name).'.php');
        }

        return parent::getPath($name);
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return array_merge([
            ['app', 'a', InputOption::VALUE_REQUIRED, 'The application directory.'],
        ], parent::getOptions());
    }
}
