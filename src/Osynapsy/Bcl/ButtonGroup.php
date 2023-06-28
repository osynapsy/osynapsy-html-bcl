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

use Osynapsy\Html\Component\AbstractComponent;
use Osynapsy\Html\Tag;

/**
 * Impelementation of Bootstrap ButtonGroup
 *
 * @author Pietro Celeste <p.celeste@osyanpsy.net>
 */
class ButtonGroup extends AbstractComponent
{
    protected $ul;
    protected $b1;
    protected $b2;

    public function __construct($name, $label, $class='')
    {
        parent::__construct('div', $name);
        $this->addClass('btn-group');
        $this->b1 = $this->add($this->firstButtonFactory($name, $label, $class));
        $this->b2 = $this->add($this->secondButtonFactory($name, $class));        
        $this->ul = $this->add($this->dropdownMenuFactory());
    }
    
    protected function firstButtonFactory($name, $label, $class)
    {
        return new Button('btn1'.$name, $label, $class);
    }
    
    protected function secondButtonFactory($name, $class)
    {
        $Button = new Button('btn2'.$name, '<span class="caret"></span>', "dropdown-toggle $class");
        $Button->attributes([
            'data-toggle' => 'dropdown',
            'aria-haspopup' => 'true',
            'aria-expandend' => 'false'
        ]);
        $Button->add('<span class="sr-only">Toggle Dropdown</span>');
        return $Button;
    }
    
    protected function dropdownMenuFactory()
    {
        return new Tag('ul', 'dropdown-menu');        
    }

    public function push($item)
    {
        $li = $this->ul->add(new Tag('li'));
        $li->add($item);
        return is_string($item) ? $this : $item;
    }

    public function addSeparator()
    {
        $this->ul->add(new Tag('li', null, 'divider'))->attribute('role','separator');
    }
}
