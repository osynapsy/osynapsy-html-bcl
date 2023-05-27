<?php

/*
 * This file is part of the Osynapsy package.
 *
 * (c) Pietro Celeste <p.celeste@osynapsy.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Osynapsy\Bcl;

use Osynapsy\Html\Component\CheckList as BaseCheckList;
use Osynapsy\Html\DOM;

/**
 * Build a list of check
 *
 */
class CheckList extends BaseCheckList
{
    /**
     *
     * @param string $name
     */
    public function __construct($name)
    {
        parent::__construct($name);
        DOM::requireCss('Bcl4/CheckList/style.css');
    }
}
