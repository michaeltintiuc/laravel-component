<?php
namespace MichaelT\Component\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class ComponentMakeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:component {component}';

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
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
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
        // TODO: parse file
        $this->files->exists($file);
    }

    /**
     * Get the clean component name from input
     * 
     * @return string
     */
    private function getName()
    {
        return trim($this->argument('name'));
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the component'],
        ];
    }
}
