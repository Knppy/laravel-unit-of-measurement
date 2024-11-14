<?php

namespace Knppy\UnitOfMeasurement\Commands;

use Illuminate\Console\Command;

class UnitOfMeasurementCommand extends Command
{
    public $signature = 'laravel-unit-of-measurement';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
