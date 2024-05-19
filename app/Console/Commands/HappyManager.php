<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class HappyManager extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:HappyManager {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a HappyManager structure';

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
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('name');

        $this->createDirectoryStructure($name);
        $this->createFiles($name);

        $this->info('HappyManager structure created successfully.');
    }

    /**
     * Create the directory structure.
     *
     * @param string $name
     * @return void
     */
    protected function createDirectoryStructure($name)
    {
        $directories = [
            "app/{$name}/DataControl/C",
            "app/{$name}/DataControl/R",
            "app/{$name}/DataControl/U",
            "app/{$name}/DataControl/D",
            "app/{$name}/Util",
        ];

        foreach ($directories as $directory) {
            $this->files->makeDirectory($directory, 0755, true, true);
        }
    }

    /**
     * Create initial files.
     *
     * @param string $name
     * @return void
     */
    protected function createFiles($name)
    {
        $files = [
            "app/{$name}/DataControl/C/CTemplate.php" => $this->getCTemplate($name),
            "app/{$name}/DataControl/R/RTemplate.php" => $this->getRTemplate($name),
            "app/{$name}/DataControl/U/UTemplate.php" => $this->getUTemplate($name),
            "app/{$name}/DataControl/D/DTemplate.php" => $this->getDTemplate($name),
            "app/{$name}/Util/Util{$name}.php" => $this->getUtilTemplate($name),
        ];

        foreach ($files as $file => $content) {
            $this->files->put($file, $content);
        }
    }

    /**
     * Get the service class template.
     *
     * @param string $name
     * @return string
     */
    protected function getCTemplate($name)
    {
        return <<<EOT
        <?php

        namespace App\\DC\\$name;

        class TemplateOnly
        {
            public function exampleMethod()
            {
                // Your service logic here
            }
        }
        EOT;
    }

    /**
     * Get the repository class template.
     *
     * @param string $name
     * @return string
     */
    protected function getRTemplate($name)
    {
        return <<<EOT
        <?php

        namespace App\\DC\\$name;

        class TemplateOnly
        {
            public function exampleMethod()
            {
                // Your service logic here
            }
        }
        EOT;
    }

    /**
     * Get the repository class template.
     *
     * @param string $name
     * @return string
     */
    protected function getUTemplate($name)
    {
        return <<<EOT
        <?php

        namespace App\\DC\\$name;

        class TemplateOnly
        {
            public function exampleMethod()
            {
                // Your service logic here
            }
        }
        EOT;
    }

    /**
     * Get the repository class template.
     *
     * @param string $name
     * @return string
     */
    protected function getDTemplate($name)
    {
        return <<<EOT
        <?php

        namespace App\\DC\\$name;

        class TemplateOnly
        {
            public function exampleMethod()
            {
                // Your service logic here
            }
        }
        EOT;
    }

    /**
     * Get the repository class template.
     *
     * @param string $name
     * @return string
     */
    protected function getUtilTemplate($name)
    {
        return <<<EOT
        <?php

        namespace App\\Util;

        class Util
        {
            public function exampleMethod()
            {
                // Your service logic here
            }
        }
        EOT;
    }

    /**
     * Get the repository class template.
     *
     * @param string $name
     * @return string
     */
}
