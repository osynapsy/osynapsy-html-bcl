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

/**
 * Represents a Html Button.
 *
 * @author Pietro Celeste <p.celeste@osynapsy.net>
 */
class Button extends \Osynapsy\Html\Component\Button
{
    const BTN_PRIMARY = 'btn-primary';
    const BTN_SECONDARY = 'btn-secondary';
    const BTN_SUCCESS = 'btn-success';
    const BTN_DANGER = 'btn-danger';
    const BTN_WARNING = 'btn-warning';
    const BTN_INFO = 'btn-dark';
    const BTN_LIGHT = 'btn-light';
    const BTN_DARK = 'btn-dark';
    const BTN_LINK = 'btn-link';
    const BTN_SMALL = 'btn-sm';
    const BTN_LARGE = 'btn-lg';
    const BTN_BLOCK = 'btn-block';
        
    /**
     * Constructor of button component
     *
     * @param string $id     
     * @param string $class extra css class to add to button
     * @param string $label text of the button
     */
    public function __construct($id, $label = '', $class = self::BTN_PRIMARY)
    {
        parent::__construct($id, $label, trim(sprintf('btn %s', $class)));
    }
}
