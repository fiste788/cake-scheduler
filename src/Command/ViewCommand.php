<?php

declare(strict_types=1);

/**
 * Created by Li
 * Website: www.watchowl.io
 * Date: 2/10/17
 * Time: 7:32 PM
 */

namespace CakeScheduler\Command;

use Cake\Command\Command;
use Cake\Console\Arguments;
use Cake\Console\CommandInterface;
use Cake\Console\ConsoleIo;
use Cake\Console\ConsoleOptionParser;
use Crunz\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;

/**
 * CakeScheduler shell command.
 */
class ViewCommand extends Command
{
    public function buildOptionParser(ConsoleOptionParser $parser): ConsoleOptionParser
    {

        $parser->setDescription(
            'view',
            __('List of scheduled cron jobs'),
        );

        return $parser;
    }

    public function execute(Arguments $args, ConsoleIo $io): ?int
    {
        $input = new ArrayInput(array(
            'command' => 'schedule:list',
            'source' => APP . 'Command' . DS . 'Schedule'
        ));

        echo $this->runCrunzCommand($input);
        echo PHP_EOL;

        return CommandInterface::CODE_SUCCESS;
    }

    private function runCrunzCommand(InputInterface $input): void
    {
        define('CRUNZ_ROOT', ROOT . DS . 'vendor' . DS . 'lavary' . DS . 'crunz' . DS);
        $kernel = new Application('Crunz Command Line Interface', 'v2.0.0');
        $kernel->run($input);
    }
}
