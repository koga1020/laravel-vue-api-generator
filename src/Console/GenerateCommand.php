<?php

namespace Koga1020\LaravelVueApiGenerator\Console;

use Illuminate\Console\Command;

class GenerateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:spa {table_name} {--prefix=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'make laravel and vue files for spa.';

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
        $prefix = $this->option('prefix');

        if ($prefix) {
            $vuePageFolder = base_path('resources/js/views/' . $prefix . '/' . $this->argument('table_name'));
        } else {
            $vuePageFolder = base_path('resources/js/views/' . $this->argument('table_name'));
        }

        if (! is_dir($vuePageFolder)) {
            mkdir($vuePageFolder, 0755, true);
        }

        $this->indexVue($this->argument('table_name'), $vuePageFolder);
        $this->addVue($this->argument('table_name'), $vuePageFolder);
        $this->showVue($this->argument('table_name'), $vuePageFolder);
        $this->editVue($this->argument('table_name'), $vuePageFolder);
    }

    private function indexVue($tableName, $folder) 
    {
        $template = str_replace(
            ['{{tableName}}'],
            [studly_case($tableName)],
            $this->getVueStub('Index')
        );
    
        file_put_contents($folder . '/Index.vue', $template);
    }

    private function addVue($tableName, $folder) 
    {
        $template = str_replace(
            ['{{tableName}}'],
            [studly_case($tableName)],
            $this->getVueStub('Add')
        );
    
        file_put_contents($folder . '/Add.vue', $template);
    }

    private function showVue($tableName, $folder) 
    {
        $template = str_replace(
            ['{{tableName}}'],
            [studly_case($tableName)],
            $this->getVueStub('Show')
        );
    
        file_put_contents($folder . '/Show.vue', $template);
    }

    private function editVue($tableName, $folder) 
    {
        $template = str_replace(
            ['{{tableName}}'],
            [studly_case($tableName)],
            $this->getVueStub('Edit')
        );
    
        file_put_contents($folder . '/Edit.vue', $template);
    }


    private function getVueStub($pageName) {
       return file_get_contents(__DIR__ . '/stubs/' . $pageName . '.vue.stub');
    }
}
