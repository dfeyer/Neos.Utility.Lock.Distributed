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

use malkusch\lock\mutex\MemcachedMutex;
use TYPO3\Flow\Annotations as Flow;

/**
 * Memcache Implementation
 */
class MemcachedImplementation implements ImplementationInterface
{
    /**
     * @var array
     * @Flow\InjectConfiguration(path="implementation.MemcachedImplementation")
     */
    protected $configuration;

    /**
     * @param string $subject
     * @param callable $callback
     */
    public function synchronized($subject, \Callback $callback)
    {
        $memcache = new \Memcached();
        foreach ($this->configuration['servers'] as $configuration) {
            $memcache->addServer($configuration['host'], $configuration['port'], $configuration['weight']);
        }

        $mutex = new MemcachedMutex($subject, $memcache);
        $mutex->synchronized($callback);
    }
}
