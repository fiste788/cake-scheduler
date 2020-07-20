<?php

declare(strict_types=1);

/**
 * Created by Li
 * Website: www.watchowl.io
 * Date: 2/10/17
 * Time: 7:32 PM
 */

namespace CakeScheduler\Schedule;

use Cake\Core\Configure;
use Crunz\Event;
use Crunz\Schedule;

class CakeSchedule extends Schedule
{
    public function shell(string $command): Event
    {
        $binary = (string) Configure::read('CakeScheduler.phpBinary');
        return $this->run($binary . ' ' . ROOT . DS . 'bin' . DS . 'cake.php ' . $command);
    }

    public function run($command, array $parameters = []): Event
    {
        $this->loadCakeBootstrapFile();

        return parent::run($command, $parameters);
    }

    private function loadCakeBootstrapFile(): void
    {
        $root = $this->findRoot(__FILE__);

        if (!file_exists($root . '/config/bootstrap.php')) {
            throw new \Exception('bootstrap.php file is missing from config');
        }

        require_once $root . '/config/bootstrap.php';
    }

    private function findRoot(string $root): string
    {
        do {
            $lastRoot = $root;
            $root = dirname($root);
            if (is_dir($root . '/vendor/cakephp/cakephp')) {
                return $root;
            }
        } while ($root !== $lastRoot);

        throw new \Exception('Cannot find the root of the application, unable to run tests');
    }
}
