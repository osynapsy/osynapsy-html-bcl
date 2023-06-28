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
use Osynapsy\Html\Component\InputHidden;

//Costruttore del pannello html
class Accordion extends AbstractComponent
{
    private $panels = [];
    private $defaultOpen  = 0;

    public function __construct($id, $defaultOpen = 0)
    {        
        parent::__construct('div', $id);
        $this->requireCss('bcl/accordion/style.css');
        $this->requireCss('bcl/panelaccordion/style.css');
        $this->addClass('accordion osy-panel-accordion');
        $this->attribute('role', 'tablist');                
        $memoryOpen = filter_input(\INPUT_POST, $this->id);
        $this->defaultOpen = is_null($memoryOpen) ? $defaultOpen : $memoryOpen;
    }

    public function preBuild()
    {
        $this->add(new InputHidden($this->id))->setValue($this->defaultOpen);
        foreach($this->panels as $panel) {
            $this->add($panel);
        }
    }

    public function addPanel($title, $commands = [])
    {
        $panelIdx = count($this->panels);
        $panelId = $this->id.'_'.$panelIdx;
        $open = $this->defaultOpen === $panelIdx ? true : false;        
        $panelHeader = $this->accordionItemFactory($title, $panelId.'_body', $open);
        $Panel = $this->panelFactory($panelId, $panelHeader, $commands, $open);
        $this->panels[] = $Panel;
        return $this->panels[$panelIdx];
    }
    
    protected function panelFactory($panelId, $panelHeader, $commands, $open)
    {
        $Panel = new Panel($panelId, $panelHeader);
        $Panel->setClass(
            'card-body collapse'.($open ? ' show' : ''),
            'card-header',
            'card-foot',
            'card',
            ''
        );
        $Panel->addCommands($commands);
        $Panel->getBody()->attributes([
            'id' => $panelId.'_body',
            'data-parent' => '#'.$this->id
        ]);
        return $Panel;
    }

    private function accordionItemFactory($title, $targetId, $open)
    {
        $span = new Tag('span', null, 'c-pointer');
        $span->attributes([            
            'data-toggle' => 'collapse',
            'role' => 'button',
            'data-target' => '#'.$targetId,
            'aria-expanded' => empty($open) ? 'false' : 'true',
            'aria-controls' => $targetId
        ]);
        $span->add($title);
        return $span;
    }
}
