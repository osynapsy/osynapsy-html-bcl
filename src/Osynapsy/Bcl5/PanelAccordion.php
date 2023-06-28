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

use Osynapsy\Html\Component\AbstractComponent;
use Osynapsy\Html\Component\Hidden;

/**
 * 
 */
class PanelAccordion extends AbstractComponent
{
    private $panels = [];
    private $panelSelected;
    
    public function __construct($id)
    {        
        parent::__construct('div', $id);
        $this->requireCss('bcl/panelaccordion/style.css');
        $this->requireJs('bcl/panelaccordion/script.js');
        $this->addClass('panel-group osy-panel-accordion');
        $this->attribute('role','tablist');        
        $this->panelSelected = filter_input(\INPUT_POST, $this->id);
    }

    public function preBuild()
    {
        $this->add(new Hidden($this->id));
        foreach($this->panels as $panel) {
            $this->add($panel);
        }
    }

    public function addPanel($title, $commands = [])
    {
        $panelIdx = count($this->panels);
        $panelId = $this->id.$panelIdx;        
        return $this->panels[$panelIdx] = $this->panelFactory($panelId, $this->panelTitleFactory($title), $commands);        
    }
    
    protected function panelFactory($panelId, $panelTitle, $commands)
    {
        $panelIdx = count($this->panels);
        $Panel = new Panel($panelId, $panelTitle);
        $Panel->addCommands($commands);
        $Panel->getBody()->attribute('id', sprintf('%s-body', $panelId));
        $Panel->addClass('panel-body collapse' .($this->panelSelected == $panelIdx ? ' in' : ''));
        return $Panel;
    }
    
    protected function panelTitleFactory($title)
    {
        $panelIdx = count($this->panels);
        $Title = new \Osynapsy\Html\Component\Link($this>id.'_title_'.$panelIdx, sprintf('#%s-body', $panelIdx), $title);
        $Title->attributes([
            'data-toggle' => 'collapse',
            'data-parent' => '#' . $this->id,
            'data-panel-id' => $panelIdx,
            'class' => $this->panelSelected === $panelIdx ? 'collapsed' : ''
        ]);
        return $Title;
    }
}
