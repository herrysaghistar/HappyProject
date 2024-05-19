<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class CreateDataControl extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-data-control';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Insert Data Control';
    /**
     * Filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();
        $this->files = $files;
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');

        $this->createDirectoryStructure($name);
        $this->createFiles($name);

        $this->info('Insert Data Control created successfully.');
    }
}
