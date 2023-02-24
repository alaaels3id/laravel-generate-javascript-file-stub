<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class JsFileCommand extends Command
{
    protected $signature = 'js:make {model}';

    protected $description = 'Create Vuex module Command description';

    public function handle()
    {
        $name = Str::lower($this->argument('model'));

        $file_path = resource_path('/js/store/modules/' . $name . '/index.js');

        $message = self::generateFile($file_path,'js.stub');

        $this->info($message);
    }

    private static function generateFile($file_path, $stub): string
    {
        File::ensureDirectoryExists(dirname($file_path));

        if(File::exists($file_path)) return 'File Already Exists';

        File::put($file_path, file_get_contents(base_path('/stubs/' . $stub)));

        return "File created successfully";
    }
}
