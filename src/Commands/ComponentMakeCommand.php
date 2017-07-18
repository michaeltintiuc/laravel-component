<?php
namespace MichaelT\Component\Commands;

use Illuminate\Console\Command;

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
}
