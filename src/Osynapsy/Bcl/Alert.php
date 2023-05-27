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

class Alert extends Base
{
    const ALERT_INFO = 'alert-info';
    const ALERT_SUCCESS = 'alert-success';
    const ALERT_DANGER = 'alert-danger';
    const ALERT_WARNING = 'alert-warning';

    protected $rawId;
    protected $hiddenBox;
    protected $message;
    protected $type;
    protected $isDismissible = false;
    protected $icon = '';

    public function __construct($id, $message, $type = self::ALERT_INFO)
    {
        parent::__construct('div', $id.'_container');
        $this->rawId = $id;
        $this->hiddenBox = $this->add($this->hiddenFactory($id));
        $this->attributes(['class' => 'alert', 'role' => 'alert']);
        $this->setMessage($message);
        $this->setType($type);
    }
    
    protected function hiddenFactory($id)
    {
        $Hidden = new Hidden($id);
        $Hidden->setValue('0');
        return $Hidden;
    }

    public function preBuild()
    {
        $this->addClass($this->type);
        $this->add(sprintf("%s<span id=\"%s\">%s</span>", $this->icon, $this->rawId.'_label', $this->message));
        if (!$this->isDismissible) {
            return;
        }
        $this->addClass('alert-dismissible text-center');
        $this->add(' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>');
    }

    public function setDismissible($condition)
    {
        $this->isDismissible = $condition;
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function showIcon($condition)
    {
        if (!$condition) {
            $this->icon = '';
            return;
        }
        switch ($this->type) {
            case 'danger':
                $this->icon = '<span class="fa fa-exclamation-triangle" aria-hidden="true"></span><span class="sr-only">Error:</span> ';
                break;
        }
    }
}
