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
use Osynapsy\Html\Component\AbstractComponent;

class ContextMenu extends AbstractComponent
{
    private $ul;

    public function __construct($id)
    {        
        parent::__construct('div', $id);
        $this->requireCss('bcl/contextmenu/style.css');
        $this->requireJs('bcl/contextmenu/script.js');
        $this->addClass('BclContextMenu dropdown clearfix');
        $this->ul = $this->add($this->dropdownMenuFactory());                           
    }

    protected function dropdownMenuFactory()
    {
        $Dropdown = new Tag('ul', null, 'dropdown-menu');
        $Dropdown->attributes([
            'role' => 'menu',
            'aria-labelledby' => 'dropdownMenu',
            'style','display: block; position: static; margin-bottom: 5px;'
        ]);
        return $Dropdown;
    }
    
    public function addAction($label, $action, $params='')
    {
        $this->ul
             ->add(new Tag('li'))
             ->add(new Tag('a'))
             ->attribute('href','javascript:void(0);')
             ->attribute('data-action',$action)
             ->attribute('data-action-param',$params)
             ->add($label);
    }
}