<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         2.0.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
namespace CakeScheduler;

use CakeScheduler\Command as Commands;
use Cake\Console\CommandCollection;
use Cake\Core\BasePlugin;

/**
 * Plugin definition for Authorization
 */
class CakeSchedulerPlugin extends BasePlugin
{
    /**
     * Add console commands if bake is also available.
     *
     * @param \Cake\Console\CommandCollection $commands The command collection to update
     * @return \Cake\Console\CommandCollection
     */
    public function console(CommandCollection $commands): CommandCollection
    {
        $commands->add('schedule:run', Commands\RunCommand::class);
        $commands->add('schedule:view', Commands\ViewCommand::class);

        return $commands;
    }
}
