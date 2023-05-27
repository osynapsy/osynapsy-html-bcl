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

class ComboBox extends \Osynapsy\Html\Component\ComboBox
{
    public function __construct($name)
    {
        parent::__construct($name);
        $this->addClass('form-control');
    }

    public function enableSearch()
    {
        $this->addClass('selectpicker');
        $this->attribute('data-live-search', 'true');
        $this->requireCss('Bcl4/ComboBox/bootstrap-select.css');
        $this->requireJs('Bcl4/ComboBox/bootstrap-select.js');
    }

    public function setSmallSize()
    {
        $this->setClass('form-control-sm');
        return $this;
    }
}
