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
use Osynapsy\Html\Component\Hidden;
use Osynapsy\Html\DOM;

class LabelBox extends Base
{
    protected $hiddenBox;
    protected $label;

    public function __construct($id, $label='')
    {
        DOM::requireCss('bcl/labelbox/style.css');
        parent::__construct('div', $id.'_labelbox');
        $this->addClass('osynapsy-labelbox');
        $this->hiddenBox = $this->add(new Hidden($id));
        $this->add($label);
    }

    public function setValue($value)
    {
        $this->hiddenBox->setValue($value);
        return $this;
    }   

    public function setLabel($label)
    {
        $this->label = $label;
        return $this;
    }

    public function preBuild()
    {        
        $label = $this->label ?? $this->hiddenBox->getValue();        
        $this->add('<span>'.$label.'</span>');
    }
}
