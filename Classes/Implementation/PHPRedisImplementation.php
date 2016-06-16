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

use malkusch\lock\mutex\PHPRedisMutex;
use TYPO3\Flow\Annotations as Flow;

/**
 * PHPRedisImplementation Implementation
 */
class PHPRedisImplementation implements ImplementationInterface
{
    /**
     * @var array
     * @Flow\InjectConfiguration(path="implementation.PHPRedisImplementation")
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
            $redis = new \Redis();
            $redis->connect($configuration['host'], $configuration['port'], $configuration['timeout']);
            $connections[] = $redis;
        }

        $mutex = new PHPRedisMutex($connections, $subject);
        $mutex->synchronized($callback);
    }
}
