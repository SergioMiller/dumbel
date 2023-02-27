<?php

declare(strict_types=1);

namespace App\Library;

use Illuminate\Console\Command as BaseCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Command extends BaseCommand
{
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $start = microtime(true);
        $this->info(get_class($this) . ' is running.');

        $method = method_exists($this, 'handle') ? 'handle' : '__invoke';
        $result = (int) $this->laravel->call([$this, $method]);
        $this->info('Executing time ' . round((microtime(true) - $start), 3) . 's');

        return $result;
    }
}
