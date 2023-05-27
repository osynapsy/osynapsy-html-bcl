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
use Osynapsy\Html\DOM;

class FileBox extends Base
{
    protected $fileBox;
    protected $deleteCommand;
    public $showImage = false;
    public $span;

    public function __construct($name, $postfix = false, $prefix = true)
    {
         /*
            http://www.abeautifulsite.net/whipping-file-inputs-into-shape-with-bootstrap-3/
            <span class="input-group-btn">
                <span class="btn btn-primary btn-file">
                    Browse&hellip; <input type="file" multiple>
                </span>
            </span>
        */
        DOM::requireJs('bcl/filebox/script.js');
        parent::__construct('dummy', $name);
        $this->span = $this->add(new Tag('span'));
        $inputGroup = $this->add(new Tag('div', null, 'input-group'));
        $inputGroup->add(new Tag('span', null, 'input-group-btn input-group-prepend'))
            ->add(new Tag('span', null, 'btn btn-primary btn-file'))
            ->add('<input type="file" name="'.$name.'"><span class="fa fa-folder-open"></span>');
        $inputGroup->add('<input type="text" class="form-control" readonly>');
        if (!$postfix) {
            return;
        }
        $inputGroup->add($this->postfixGroupButtonFactory());
    }
    
    protected function postfixGroupButtonFactory()
    {
        $span = new Tag('span', null, 'input-group-btn input-group-append');
        $span->add($this->buttonSendFileFactory());
        return $span;
    }
    
    protected function buttonSendFileFactory()
    {
        $Button = new Tag('button', null, 'btn btn-primary');
        $Button->attribute('type', 'submit');
        $Button->add('Send');
        return $Button;
    }

    public function preBuild()
    {
        if (empty($_REQUEST[$this->id])) {
            return;
        }
        $this->downloadFileFactory();
    }

    protected function downloadFileFactory()
    {
        $pathinfo = pathinfo($_REQUEST[$this->id]);
        $filename = $pathinfo['filename'].(!empty($pathinfo['extension']) ? '.'.$pathinfo['extension'] : '');
        $download = new Tag('a');
        $download->att('target','_blank')->att('href',$_REQUEST[$this->id])->add($filename.' <span class="fa fa-download"></span>');
        $label = $this->span->add(new LabelBox('donwload_'.$this->id));
        $label->att('style','padding: 10px; background-color: #ddd; margin-bottom: 10px;');
        $label->setLabel($download, $this->deleteCommand);
        $this->span->add($label);
    }

    public function setDeleteAction($action, $parameters = [], $confirmMessage = null)
    {
        $button = new Tag('span', null, 'fa fa-close click-execute float-right');
        $button->att('data-action', $action);
        if (!empty($parameters)) {
            $button->att('data-action-parameters', implode(',', $parameters));
        }
        if (!empty($confirmMessage)) {
            $button->att('data-confirm', $confirmMessage);
        }
        $this->deleteCommand = $button;
    }
}