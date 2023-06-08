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

class PasswordBox extends \Osynapsy\Html\Component\InputPassword
{
    public function __construct($name)
    {
        parent::__construct($name);
        $this->addClass('form-control');
    }
}
