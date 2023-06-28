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

class ImageBox extends FileBox
{
    public function __construct($name)
    {        
        AbstractComponent::__construct('div');
        $this->attribute('id', $name.'_container');
        $this->requireJs('bcl/filebox/script.js');
        $this->addClass('bcl-filebox');
        $this->add($this->hiddenFactory($name));
        $this->add($this->previewFactory($name));
        $this->add($this->inputGroupFactory($name));
    }

    protected function previewFactory($name)
    {
        return $this->previewBox = new Tag('div', $name.'_preview','bcl-filebox-preview pb-1');
    }

    public function preBuild()
    {
        $filePath = $this->hiddenBox->getValue();
        if (!empty($filePath)) {
            $this->previewBox->add(sprintf('<img src="%s" style="max-width: 100%%">', $filePath));
        }
    }
}
