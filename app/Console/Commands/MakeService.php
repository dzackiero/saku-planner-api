<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeService extends Command
{
    protected $signature = 'make:service {name}';
    protected $description = 'Create a new Service class';

    public function handle()
    {
        $name = $this->argument('name');
        $className = Str::studly($name);
        $servicePath = app_path('Services');
        $filePath = $servicePath . '/' . $className . '.php';

        if (!File::exists($servicePath)) {
            File::makeDirectory($servicePath, 0755, true);
        }

        if (File::exists($filePath)) {
            $this->error('Service already exists!');
            return;
        }

        $stubPath = base_path('stubs/service.stub');

        if (!File::exists($stubPath)) {
            $this->error('Stub file not found!');
            return;
        }

        $stub = File::get($stubPath);

        // Replace placeholder
        $stub = str_replace('{{ class }}', $className, $stub);

        File::put($filePath, $stub);

        $this->info("Service {$className} created successfully.");
    }
}
