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

use Osynapsy\Html\Tag;
use Osynapsy\Html\Component\Base;
use Osynapsy\Html\Component\Check;
use Osynapsy\Html\Component\Hidden;

/**
 * Description of Switcher
 *
 * @author Pietro Celeste <p.celeste@osynapsy.net>
 */
class Switcher extends Base
{
    protected $check;
    protected $label;

    public function __construct($id, $label, $value = 1)
    {
        parent::__construct('div', $id.'_container');
        $this->addClass('custom-control custom-switch');
        $this->add($this->hiddenFactory($id));
        $this->check = $this->add($this->checkFactory($id, $value));        
        $this->label = $this->add($this->labelFactory($id, $label));
    }
    
    protected function hiddenFactory($id)
    {
        $Hidden = new Hidden($id, $id);
        $Hidden->setValue('0');
        return $Hidden;
    }
    
    protected function checkFactory($id, $value)
    {
        $Check = new Check($id, $id, $value);
        $Check->addClass('custom-control-input');
        return $Check;
    }
    
    protected function labelFactory($id, $label)
    {
        $Label = new Tag('label', null, "custom-control-label");
        $Label->attribute('for', $id);
        $Label->add($label);
        return $Label;
    }

    public function getCheck()
    {
        return $this->check;
    }

    public function setAction($action, $parameters = null, $confirmMessage = null, $class = 'click-execute')
    {
        $this->getCheck()->setAction($action, $parameters, $confirmMessage, $class);       
        return $this;
    }

    public function setDisabled($condition)
    {
        $this->getCheck()->setDisabled($condition);
    }
    
    public function setChecked($condition)
    {
        $this->getCheck()->setChecked($condition);
    }
}
