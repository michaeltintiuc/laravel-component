<?php
namespace MichaelT\Component\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Composer;
use Illuminate\Filesystem\Filesystem;

class ComponentMakeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:component {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate component structure and routes';

    /**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * The Composer instance.
     *
     * @var \Illuminate\Support\Composer
     */
    protected $composer;

    /**
     * Create a new command instance.
     * 
     * @param  \Illuminate\Filesystem\Filesystem $files
     * @param  \Illuminate\Support\Composer $composer
     * @return void
     */
    public function __construct(Filesystem $files, Composer $composer)
    {
        parent::__construct();

        $this->files = $files;
        $this->composer = $composer;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // TODO
    }

    private function fileExists($file)
    {
        $modelName = $this->getModelName();
        $className = $this->getClassName();

        // TODO: parse stubs
        // TODO: generate files

        $this->files->exists($file);
    }

    /**
     * Get the model name
     * 
     * @return string
     */
    private function getModelName()
    {
        return ucfirst($this->getNameSingular());
    }

    /**
     * Get the class name
     * 
     * @return string
     */
    private function getClassName()
    {
        return ucfirst($this->getNamePlural());
    }

    /**
     * Get the plural form of the component name from input
     * 
     * @return string
     */
    private function getNamePlural()
    {
        return str_plural($this->getName());
    }

    /**
     * Get the singular form of the component name from input
     * 
     * @return string
     */
    private function getNameSingular()
    {
        return str_singular($this->getName());
    }

    /**
     * Get the clean component name from input
     * 
     * @return string
     */
    private function getName()
    {
        return trim(strtolower($this->argument('name')));
    }
}
