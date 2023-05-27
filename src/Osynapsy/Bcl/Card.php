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

class Card extends Base
{
    private $sections = [
        'header' => null,
        'body' => null,
        'footer' => null
    ];

    private $classCss = [
        'main' => 'card',
        'header' => 'card-header',
        'body' => 'card-body',
        'foot' => 'card-footer',
        'title' => 'card-title',
        'row'   => 'row',
        'cell'  => ''
    ];

    private $currentRow = null;
    private $currentColumn = null;
    private $title;
    private $commands = [];
    protected $collapsable = false;
    public $monoRow = false;

    public function __construct($id, $class = 'card', $tag = 'div')
    {
        parent::__construct($tag, $id);
        $this->classCss['main'] = $class;
        $this->sections['body'] = new Tag($tag);
    }

    public function addCommands(array $commands = [])
    {
        $this->commands = array_merge($this->commands, $commands);
        return $this;
    }

    public function preBuild()
    {
        if (!empty($this->title)) {
            $this->add($this->buildTitle());
        }
        if (!empty($this->commands)) {
            $this->getHead()->add($this->buildCommands());
        }
        parent::addClass($this->classCss['main']);
        //var_dump('ci sono' . $this->getAttribute('class'));
        foreach ($this->sections as $key => $section){
            if (!empty($section)) {
                $section->addClass($this->classCss[$key]);
                $this->add($section);
            }
        }
    }

    protected function buildCommands()
    {
        $container = new Tag('div', null, 'ml-auto p2 panel-commands');
        foreach($this->commands as $command) {
            $container->add($command);
        }
        return $container;
    }

    protected function buildTitle()
    {
        $container = new Tag('div', null, $this->classCss['title']);
        $container->add($this->title);
        if ($this->collapsable) {
            $container->add('&nbsp;');
            $container->add($this->collapsableCommandFactory());
        }
        return $container;
    }

    protected function collapsableCommandFactory()
    {
        $iconFa = 'fa fa-arrow-down';
        $command = new Tag('small', null, $iconFa);
        $command->onclick = "$(this).toggleClass('fa-arrow-down').toggleClass('fa-arrow-right');";
        return $command;
    }

    public function addRow()
    {
        $this->currentRow = $this->sections['body']->add(
            new Tag('div', null, $this->classCss['row'])
        );
        $this->currentRow->length = 0;
        return $this->currentRow;
    }

    public function addColumn($colspan = 12, $offset = 0)
    {
        if (empty($this->currentRow) || ($this->currentRow->length + $colspan + $offset > 12 && empty($this->monoRow))) {
            $this->addRow();
        }
        $this->currentColumn = $this->currentRow->add(new Column($colspan, $offset));
        $this->currentColumn->addClass($this->classCss['cell']);
        $this->currentRow->length += $colspan;
        return $this->currentColumn;
    }

    public function getBody()
    {
        return $this->sections['body'];
    }

    public function getHead()
    {
        if (empty($this->sections['header'])) {
            $this->sections['header'] = new Tag('div', null, 'd-flex');
        }
        return $this->sections['header'];
    }

    public function getRow()
    {
        return $this->currentRow;
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

    public function addClass($class)
    {
        $this->classCss['main'] .= ' '.$class;
        return $this;
    }

    public function addClassRow($class)
    {
        $this->classCss['row'] .= ' '.$class;
    }

    public function addClassCell($class)
    {
        $this->classCss['cell'] .= ' '.$class;
    }

    public function enableMonoRow()
    {
        $this->monoRow = true;
    }

    public function noPadding()
    {
        $this->addClassRow('no-gutters');
    }

    public function setHeight100()
    {
        $this->addClass('h-100 d-line-block');
    }

    public function setText($text)
    {
        if (!empty($text)) {
            $this->getBody()->add(sprintf('<p class="card-text">%s</p>', $text));
        }
    }

    public function setInsideTitle($title, $tag = 'h5', $class = '')
    {
        $this->getBody()->add(new Tag($tag, null, trim('card-title '.$class)))->add($title);
    }

    public function setTitle($title, array $commands = [])
    {
        $titleContainer = $this->getHead()->add(new Tag('div', null, 'd-flex'));
        $titleContainer->add(new Tag('div', null, 'card-title-label'))->add($title);
        if ($this->collapsable) {
            $titleContainer->add($this->collapsableCommandFactory());
        }
        if (!empty($commands)) {
            $this->getHead()->add(new Tag('div', null, 'ml-auto p2'))->addFromArray($commands);
        }
    }

    public function setCommand($command)
    {
        $this->setClass('position-relative mr-3');
        $container = $this->add(new Tag('div', null, 'card-command ml-auto'));
        $container->attribute('style', 'top: 5px; right: 5px;')->add($command);
    }

    public function simulateTable(bool $padding = true)
    {
        $this->classCss['body'] .= ' d-table';
        $this->addClassRow('d-table-row');
        $this->addClassCell('d-table-cell');
        if (!$padding) {
            $this->noPadding();
        }
    }

    public function setTopLeftIndex(int $top, int $left, int $width = 200)
    {
        $this->attributeribute('style', sprintf('position: fixed; z-index: 1030; top: %spx; left: %spx; width: %spx;', $top, $left, $width));
    }

    public function setTopRightIndex(int $top, int $right, int $width = 200)
    {
        $this->attribute('style', sprintf('position: fixed; z-index: 1030; top: %spx; right: %spx; width: %spx;', $top, $right, $width));
    }

    public function setCollapsable($collapsable = true)
    {
        $this->collapsable = $collapsable;
    }
}
