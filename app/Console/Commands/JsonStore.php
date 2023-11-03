<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class JsonStore extends Command
{
    protected $signature = 'json:store {name}';

    protected $description = 'Generates a JSON file to test GitHub action store';

    public function handle(): int
    {
        $filePath = sprintf('foo/%s.json', $this->argument('name'));

        if (Storage::exists($filePath)) {
            $this->line('FILE ALREADY EXIST');
        } else {
            $this->line('Creating new file...');
            Storage::put(
                $filePath,
                json_encode(['foo' => 'bar'], JSON_PRETTY_PRINT)
            );
            $this->line('Successfully created a new file');
        }

        return 0;
    }
}
