<?php
namespace Neos\Utility\Lock\Distributed;

/*
 * This file is part of the Neos.Utility.Lock.Distributed package.
 *
 * (c) Contributors of the Neos Project - www.neos.io
 *
 * This package is Open Source Software. For the full copyright and license
 * information, please view the LICENSE file which was distributed with this
 * source code.
 */
use Neos\Utility\Lock\Distributed\Implementation\ImplementationInterface;
use TYPO3\Flow\Utility\Lock\LockCallbackStrategyInterface;
use TYPO3\Flow\Annotations as Flow;

/**
 * A Distributed lock strategy.
 */
class DistributedLockStrategy implements LockCallbackStrategyInterface
{
    /**
     * @var ImplementationInterface
     * @Flow\Inject
     */
    protected $implementation;

    /**
     * @param string $subject
     * @param \Closure $callback
     */
    public function synchronized($subject, \Closure $callback)
    {
        $this->implementation->synchronized($subject, $callback);
    }
}
