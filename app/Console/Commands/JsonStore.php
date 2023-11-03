<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class JsonStore extends Command
{
    protected $signature = 'json:store {date}';

    protected $description = 'Generates a JSON file to test GitHub action store';

    public function handle(): int
    {
        $ts = strtotime($this->argument('date'));

        if ($ts === false) {
            $this->line('Unable to parse "date" argument');

            return 1;
        }

        $filePath = sprintf(
            'foo/%s.json',
            $date = Carbon::createFromTimestamp($ts)->format('Y-M-d')
        );

        if (Storage::exists($filePath)) {
            $this->line(sprintf('File "%s" already exist', $filePath));
        } else {
            $this->line(sprintf('Creating file named: %s', $filePath));
            Storage::put(
                $filePath,
                json_encode(['date' => $date], JSON_PRETTY_PRINT)
            );
            $this->line(sprintf('Successfully created a file named: %s', $filePath));
        }

        return 0;
    }
}
