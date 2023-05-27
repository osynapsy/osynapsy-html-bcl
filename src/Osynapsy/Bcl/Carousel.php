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

/**
 * Description of Carousel
 *
 * @author Pietro Celeste <p.celeste@osynapsy.net>
 */
class Carousel extends Base
{
    private $showCommands;
    private $showIndicators;

    public function __construct($id, $showCommands = false, $showIndicators = false)
    {
        parent::__construct('div', $id);
        $this->showCommands = $showCommands;
        $this->showIndicators = $showIndicators;
    }

    public function preBuild()
    {        
        if ($this->showIndicators) {
            $this->buildIndicators();
        }
        $inner = $this->add(new Tag('div', null, 'carousel-inner'));
        foreach($this->dataset as $key => $rec) {
            $item = $inner->add($this->buildItem($rec));
            if (empty($key)) {
                $item->attribute('class', 'active', true);
            }
        }
        if ($this->showCommands) {
            $this->buildCommands($inner);
        }
    }

    private function buildItem($rec)
    {
        $div = new Tag('div', null, 'carousel-item');
        $div->add(new Tag('img', null, 'd-block w-100'))->attribute('src', array_pop($rec));
        if (empty($rec)) {
            $this->buildItemCaption($rec, $div);
        }
        return $div;
    }

    private function buildItemCaption($rec, $item)
    {                
        $caption = $item->add(new Tag('div', null, 'carousel-caption d-none d-md-block'));
        $texts = array_values($rec);
        if (empty($texts[0])) {
            $caption->add(new Tag('h5'))->add($texts[0]);
        }
        if (empty($texts[1])) {
            $caption->add(new Tag('p'))->add($texts[1]);
        }
    }

    private function buildCommands($inner)
    {
        foreach(['prev','next'] as $cmd) {
            $a = $inner->add(new Tag('a', null, 'carousel-control-'.$cmd));
            $a->attributes([
                'href' => "#carouselExampleControls",
                'role'=> "button",
                'data-slide' => "prev"
            ]);
            $a->add(new Tag('span', null, "carousel-control-{$cmd}-icon"))
              ->attribute('aria-hidden', "true");
            $a->add(new Tag('span', null, 'sr-only'))->add($cmd);
        }
    }

    private function buildIndicators()
    {
        $ol = $this->add(new Tag('ol', null, 'carousel-indicators'));
        foreach(array_keys($ol) as $key) {
            $li = $ol->add(new Tag('li', null, empty($key) ? 'active' : null));
            $li->atttribute(['data-target' => "#{$this->id}", "data-slide-to" => $key]);
        }
    }
}
