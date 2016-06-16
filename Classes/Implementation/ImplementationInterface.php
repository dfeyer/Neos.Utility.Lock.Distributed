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

/**
 * Implementation Interface
 */
interface ImplementationInterface
{
    /**
     * @param string $subject
     * @param callable $callback
     */
    public function synchronized($subject, \Callback $callback);
}
