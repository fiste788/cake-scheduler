<?php

/**
 * Created by Li
 * Website: www.watchowl.io
 * Date: 2/10/17
 * Time: 7:32 PM
 */

namespace CakeScheduler\Command;

use Cake\Command\Command;
use Crunz\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;

/**
 * CakeScheduler shell command.
 */
class CakeSchedulerViewCommand extends Command
{
    public function getOptionParser()
    {
        $parser = parent::getOptionParser();

        $parser->setDescription(
            'view',
            __('List of scheduled cron jobs'),
        );

        return $parser;
    }

    public function execute()
    {
        $input = new ArrayInput(array(
            'command' => 'schedule:list',
            'source' => APP . 'Command' . DS . 'Schedule'
        ));

        echo $this->runCrunzCommand($input);
        echo PHP_EOL;
    }

    private function runCrunzCommand(InputInterface $input)
    {
        define('CRUNZ_ROOT', ROOT . DS . 'vendor' . DS . 'lavary' . DS . 'crunz' . DS);
        $kernel = new Application('Crunz Command Line Interface', 'v2.0.0');
        $kernel->run($input);
    }
}
