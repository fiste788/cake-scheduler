<?php
/**
 * Created by Li
 * Website: www.watchowl.io
 * Date: 2/10/17
 * Time: 7:32 PM
 */

namespace CakeScheduler\Shell;

use Cake\Console\Shell;
use Crunz\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;

/**
 * CakeScheduler shell command.
 */
class CakeSchedulerShell extends Shell
{
    public function getOptionParser()
    {
        $parser = parent::getOptionParser();

        $parser->addSubcommand('run', [
            'parser' => [
                'description' => [
                    __('Run the scheduler'),
                ]
            ]
        ]);

        $parser->addSubcommand('view', [
            'parser' => [
                'description' => [
                    __('List of scheduled cron jobs'),
                ]
            ]
        ]);

        return $parser;
    }

    public function main()
    {
        $this->out($this->OptionParser->help());
        return true;
    }

    public function run()
    {
        $input = new ArrayInput(array(
           'command' => 'schedule:run',
           'source' => APP . 'Shell' . DS . 'Schedule'
        ));
        
        echo $this->runCrunzCommand($input);
        echo PHP_EOL;
    }

    public function view()
    {
        $input = new ArrayInput(array(
           'command' => 'schedule:list',
           'source' => APP . 'Shell' . DS . 'Schedule'
        ));
        
        echo $this->runCrunzCommand($input);
        echo PHP_EOL;
    }
    
    private function runCrunzCommand(InputInterface $input) {
        define('CRUNZ_ROOT', ROOT . DS . 'vendor' . DS . 'lavary' . DS . 'crunz' . DS);
        $kernel = new Application('Crunz Command Line Interface', 'v2.0.0');
        $kernel->run($input);
    }
}
