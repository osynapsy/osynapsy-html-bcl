<?php

/*
 * This file is part of the Osynapsy package.
 *
 * (c) Pietro Celeste <p.celeste@osynapsy.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Osynapsy\Bcl5;

use Osynapsy\Html\Tag;
use Osynapsy\Html\Component\AbstractComponent;

/**
 * Description of Dropdown
 *
 * @author Pietro Celeste <p.celeste@osynapsy.net>
 */
class Dropdown extends AbstractComponent
{
    const ALIGN_LEFT = 'left';
    const ALIGN_RIGHT = 'right';

    private $button;
    private $align;

    public function __construct($name, $label, $align = self::ALIGN_LEFT, $tag = 'div')
    {
        parent::__construct($tag);
        $this->addClass('dropdown');
        $this->button = $this->add($this->mainButtonFactory($name, $label));
        $this->align = $align;
    }

    private function mainButtonFactory($name, $label)
    {
        $Button = new Button($name.'_btn', $label, 'btn-primary dropdown-toggle');
        $Button->attributes([
            'data-bs-toggle' => 'dropdown',            
            'aria-expanded' => 'false'
        ]);
        return $Button;
    }

    public function preBuild()
    {
        $list = $this->add(new Tag('div', null, 'dropdown-menu dropdown-menu-'.$this->align));
        $list->attribute('aria-labelledby', $this->getButton()->id);
        foreach ($this->dataset as $rec) {
            if (is_object($rec) && $rec instanceof Tag) {
                $list->add($rec)->addClass('dropdown-item');
                continue;
            }
            if ($rec === 'divider') {
                $list->add(new Tag('div', null, 'dropdown-divider'));
                continue;
            }
        }
    }        

    public function getButton()
    {
        return $this->button;
    }
    
    public function setDisabled($condition)
    {
        $this->getButton()->setDisabled($condition);
        return $this;
    }
}
