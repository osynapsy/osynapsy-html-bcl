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

use Osynapsy\Html\DOM;
use Osynapsy\Html\Tag;

class ImageBox extends FileBox
{
    public function __construct($name)
    {
        DOM::requireJs('bcl/filebox/script.js');
        \Osynapsy\Html\Component\Base::__construct('div', $name.'_container');
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
