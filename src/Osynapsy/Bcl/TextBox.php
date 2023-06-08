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

class TextBox extends \Osynapsy\Html\Component\InputText
{    
    public function __construct($name, $class = '')
    {
        parent::__construct($name);
        $this->addClass(trim('form-control '.$class));
    }
   
    public function setSmallSize()
    {
        $this->setClass('form-control-sm');
        return $this;
    }
}
