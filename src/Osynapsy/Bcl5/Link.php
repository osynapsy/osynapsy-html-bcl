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

use Osynapsy\Html\Component\Link as BaseLink;

class Link extends BaseLink
{
    public function openInModal($title, $widht = '640px', $height = '480px', $postData = false)
    {
        $this->addClass('openInModal');
        $this->attributes([
            'title' => $title,
            'modal-width' => $widht,
            'modal-height' => $height
        ]);
        if ($postData) {
            $this->addClass('post-data');
        }
    }

    public function setDisabled($condition)
    {
        if ($condition) {
            $this->attributes([
                'href' => 'javascript:void(0);',
                'onclick' => 'event.stopPropagation();'
            ]);
            parent::setDisabled($condition);
        }
        return $this;
    }
}
