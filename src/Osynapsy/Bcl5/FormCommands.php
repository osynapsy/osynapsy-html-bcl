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

/**
 * Description of FormCommands
 *
 * @author Pietro Celeste <p.celeste@osynapsy.net>
 */
trait FormCommands
{
    public function buttonBackFactory()
    {
        return new Button('btn_back', '<span class="fa fa-arrow-left"></span> Indietro', 'command-back btn-secondary');
    }

    public function buttonCloseModalFactory()
    {
        $Button = new Button('btn_close', '<span class="fa fa-times"></span> Chiudi', 'command-close-modal btn-secondary');
        $Button->attribute('onclick', "parent.Osynapsy.modal.instance.hide();");
        return $Button;
    }

    public function buttonDeleteFactory($label = true, $alert = 'Sei sicuro di voler procedere con l\'eliminazione ?')
    {        
        $Button = new Button('btn_delete', $label === true ? '<span class="fa fa-trash-o"></span> Elimina' : $label, 'btn-danger');
        $Button->setAction('delete', [], $alert);
        return $Button;
    }

    public function buttonSaveFactory($label = true)
    {        
        $Button = new Button('btn_save', $label === true ? '<span class="fa fa-floppy-o"></span> Salva' : $label, 'btn-primary');
        $Button->setAction('save');
        return $Button;
    }
}
