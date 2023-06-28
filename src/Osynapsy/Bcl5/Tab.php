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
use Osynapsy\Html\Component\InputHidden;

/**
 * Description of Tab
 *
 * @author Pietro Celeste <p.celeste@osynapsy.net>
 */
class Tab extends AbstractComponent
{
    private $ul;
    private $nCard = 0;
    private $currentCard;
    private $tabContent;
    private $tabSelected;
    private $id;

    public function __construct($id)
    {        
        parent::__construct('div');
        $this->requireJs('bcl/tab/script.js');
        $this->id = $id;        
        $this->add(new InputHidden($id));
        $this->ul = $this->add(new Tag('ul'))->attributes([
            'id' => $id.'_nav',
            'class' => 'nav nav-tabs mt-1',
            'role' => 'tablist',
            'data-tabs' => 'tabs'
        ]);
        $this->tabSelected = empty($_REQUEST[$this->id]) ? "#{$this->id}_0" : $_REQUEST[$this->id];
        $this->tabContent = $this->add(new Tag('div', null, 'tab-content p-2 bg-white border-left border-right border-bottom'));
    }

    public function addCard($title)
    {
        $cardId = "#{$this->id}_".$this->nCard++;
        $selectedClassLink = $selectedClassPanel = '';
        if($this->tabSelected == $cardId) {
            $selectedClassLink = ' active';
            $selectedClassPanel = ' active show';
        }
        $li = $this->ul->add(new Tag('li', null, 'nav-item'))->att('role','presentation');
        $li->add('<a href="'.$cardId.'" data-toggle="tab" class="nav-link'.$selectedClassLink.'">'.$title.'</a>');
        $this->currentCard = $this->tabContent->add(new PanelTk(substr($cardId,1)))->setClass('tab-pane fade'.$selectedClassPanel);
        return $this->currentCard;
    }

    public function put($label, $object, $col, $row, $width = 1, $colspan = null, $class = '')
    {
        $this->currentCard->put($label, $object, $col, $row, $width, $colspan, $class);
    }

    public function setType($type)
    {
        $this->currentCard->setType($type);
    }
}
