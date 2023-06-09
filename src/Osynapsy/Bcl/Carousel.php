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
use Osynapsy\Html\Component\Button;
use Osynapsy\Html\DOM;

/**
 * Description of Carousel
 *
 * @author Pietro Celeste <p.celeste@osynapsy.net>
 */
class Carousel extends Base
{
    private $showCommands;
    private $showIndicators;
    private $height = 0;
    
    public function __construct($id, $showCommands = false, $showIndicators = false)
    {
        parent::__construct('div', $id);
        $this->showCommands = $showCommands;
        $this->showIndicators = $showIndicators;
        $this->addClass('carousel slide');
        DOM::requireJsCode(
            sprintf(
                "const carousel = new bootstrap.Carousel(document.querySelector('#%s'), {interval: 3000, touch: false});",
                $this->id
            )
        );
    }

    public function preBuild()
    {        
        if ($this->showIndicators) {
            $this->buildIndicators();
        }
        $inner = $this->add(new Tag('div', null, 'carousel-inner'));
        foreach($this->dataset as $key => $rec) {
            $item = $inner->add($this->carouselItemFactory($rec));
            if (empty($key)) {
                $item->addClass('active');
            }
        }
        if ($this->showCommands) {
            $this->buildCommands($inner);
        }
    }

    protected function carouselItemFactory($rec)
    {
        $carauselItem = new Tag('div', null, 'carousel-item');
        $image = $carauselItem->add(new Tag('img', null, 'd-block w-100 opacity-25'))->attribute('src', $rec[1]);
        if (!empty($rec[0])) {
            $carauselItem->add($this->captionItemFactory($rec[0]));
        }
        if (!empty($this->height)) {
            $image->addStyle('max-height', $this->height.'px');
            $carauselItem->addStyle('overflow', 'hidden');
        }
        return $carauselItem;
    }

    protected function captionItemFactory($rec)
    {                
        $caption = new Tag('div', null, 'carousel-caption d-none d-md-block');
        list($title, $description) = array_values($rec);
        if (!empty($title)) {
            $caption->add(new Tag('h5'))->add($title);
        }
        if (!empty($description)) {
            $caption->add(new Tag('p'))->add($description);
        }
        return $caption;
    }

    private function buildCommands()
    {
        foreach(['prev','next'] as $command) {
            $this->add($this->buttonCommandFactory($command));
        }
    }

    protected function buttonCommandFactory($command)
    {
        $Button = new Button(false, '', 'carousel-control-'.$command);
        $Button->attributes([
            'data-bs-target' => sprintf('#%s', $this->id),
            'data-bs-slide' => $command
        ]);
        $Button->add(new Tag('span', null, sprintf('carousel-control-%s-icon', $command)))->attribute('aria-hidden', 'true');
        $Button->add(new Tag('span', null, 'visually-hidden'))->add($command);
        return $Button;
    }

    private function buildIndicators()
    {
        $ol = $this->add(new Tag('ol', null, 'carousel-indicators'));
        foreach(array_keys($ol) as $key) {
            $li = $ol->add(new Tag('li', null, empty($key) ? 'active' : null));
            $li->atttribute(['data-target' => "#{$this->id}", "data-slide-to" => $key]);
        }
    }

    public function autoPlay($condition)
    {
        if ($condition) {
            $this->attribute('data-bs-ride', 'carousel');
        }
    }

    public function darkTheme($condition)
    {
        if ($condition) {
            $this->attribute('data-bs-theme', 'dark');
        }
    }

    public function addSlide(array $caption, $slideUrl, $interval = 3000)
    {
        $this->dataset[] = [$caption, $slideUrl, $interval];
    }

    public function setHeight($height)
    {
        $this->height = $height;
        $this->addStyle('max-height', $height.'px');
    }
}
