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

use Osynapsy\Html\Component\Base;
use Osynapsy\Html\Tag;

class Panel extends Base
{
    private $panelSections = [
        'head' => null,
        'body' => null,
        'foot' => null
    ];

    private $classCss = [
        'main' => 'panel',
        'head' => 'panel-heading clearfix',
        'body' => 'panel-body',
        'foot' => 'panel-footer',
        'title' => 'panel-title'
    ];

    private $currentRow = null;
    private $currentColumn = null;    
    private $commands = [];
    private $title;

    public function __construct($id, $class = ' panel-default', $tag = 'div')
    {
        parent::__construct($tag, $id);
        $this->classCss['main'] = sprintf('panel ', $class);
        $this->panelSections['body'] = new Tag('div');        
    }

    public function addCommands(array $commands = [])
    {
        $this->commands = array_merge($this->commands, $commands);
        return $this;
    }

    public function preBuild()
    {
        $this->addClass($this->classCss['main']);
        if (!empty($this->title)) {
            $this->getHead()->add($this->titleFactory());
        }
        if (!empty($this->commands)) {
            $this->getHead()->add($this->commandsFactory());
        }        
        foreach ($this->panelSections as $key => $section){
            if (!empty($section)) {
                $section->addClass($this->classCss[$key]);
                $this->add($section);
            }            
        }
    }

    protected function titleFactory()
    {                        
        return sprintf('<div class="%s float-start">%s</div>', $this->classCss['title'], $this->title);
    }
    
    protected function commandsFactory()
    {                
        $container = new Tag('div', null, 'float-end panel-commands mb-2');
        $container->addFromArray($this->commands);        
        return $container;
    }
    
    public function addRow($class = 'row')
    {
        $this->currentRow = $this->getBody()->add(new Tag('div', null, $class));
        $this->currentRow->length = 0;
        return $this->currentRow;
    }

    public function addColumn($colspan = 12, $offset = 0) : Column
    {
        if (empty($this->currentRow) || ($this->currentRow->length + $colspan + $offset > 12)) {
            $this->addRow();
        }
        $this->currentColumn = $this->currentRow->add(new Column($colspan, $offset));
        $this->currentRow->length += $colspan;
        return $this->currentColumn;
    }

    public function getBody()
    {
        return $this->panelSections['body'];
    }

    public function getHead()
    {
        if (empty($this->panelSections['head'])) {
            $this->panelSections['head'] = new Tag('div');
        }
        return $this->panelSections['head'];
    }

    public function resetClass()
    {
        $this->setClass('','','','');
    }   

    public function setClass($body, $head = null, $foot = null, $main = null, $title = null)
    {
        $this->classCss['body'] = $body;
        if (!is_null($head)) {
            $this->classCss['head'] = $head;
        }
        if (!is_null($foot)) {
            $this->classCss['foot'] = $foot;
        }
        if (!is_null($main)) {
            $this->classCss['main'] = $main;
        }
        if (!is_null($title)) {
            $this->classCss['title'] = $title;
        }
        return $this;
    }
    
    public function setTitle($title = '', array $commands = [])
    {
        $this->title = $title;
        $this->commands = $commands;
    }
}
