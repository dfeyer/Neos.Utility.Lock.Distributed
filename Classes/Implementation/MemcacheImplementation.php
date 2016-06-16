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

use malkusch\lock\mutex\MemcacheMutex;
use TYPO3\Flow\Annotations as Flow;

/**
 * Memcache Implementation
 */
class MemcacheImplementation implements ImplementationInterface
{
    /**
     * @var array
     * @Flow\InjectConfiguration(path="implementation.MemcacheImplementation")
     */
    protected $configuration;

    /**
     * @param string $subject
     * @param callable $callback
     */
    public function synchronized($subject, \Callback $callback)
    {
        \TYPO3\Flow\var_dump($subject);
        $memcache = new \Memcache();
        $memcache->connect($this->configuration['host'], $this->configuration['port'], $this->configuration['timeout']);

        $mutex = new MemcacheMutex($subject, $memcache);
        $mutex->synchronized($callback);
    }
}
