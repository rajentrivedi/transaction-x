<?php

namespace RajenTrivedi\TransactionX\Commands;

use Illuminate\Console\Command;

class TransactionXCommand extends Command
{
    public $signature = 'transaction-x';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
