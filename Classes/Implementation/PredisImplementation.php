<?php
namespace Neos\Utility\Lock\Distributed\Implementation;

/*
 * This file is part of the Neos.Utility.Lock.Distributed package.
 *
 * (c) Contributors of the Neos Project - www.neos.io
 *
 * This package is Open Source Software. For the full copyright and license
 * information, please view the LICENSE file which was distributed with this
 * source code.
 */

use malkusch\lock\mutex\PredisMutex;
use Predis\Client;
use TYPO3\Flow\Annotations as Flow;

/**
 * PredisImplementation Implementation
 */
class PredisImplementation implements ImplementationInterface
{
    /**
     * @var array
     * @Flow\InjectConfiguration(path="implementation.PredisImplementation")
     */
    protected $configuration;

    /**
     * @param string $subject
     * @param callable $callback
     */
    public function synchronized($subject, \Callback $callback)
    {
        $connections = [];
        foreach ($this->configuration['servers'] as $configuration) {
            $redis = new Client($configuration['parameters'], $configuration['options']);
            $connections[] = $redis;
        }

        $mutex = new PredisMutex($connections, $subject);
        $mutex->synchronized($callback);
    }
}
