<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Osynapsy\Bcl\Form;
require_once 'StringClean.php';

final class FormTest extends TestCase
{
    use StringClean;
    
    public function testForm(): void
    {
        $Form = new Form('test');
        $this->assertEquals(
            '<form id="test" name="test" method="post" role="form"><div id="testPanel" class="m-2 p-2 panel"><div class="panel-body"></div></div></form>',
            $this->tabAndEolRemove((string) $Form)
        );
    }

    public function testFormAddCell(): void
    {        
        $Form = new Form('test');
        $Form->getPanel()->addColumn()->push('test label', 'test content');
        $this->assertEquals(
            '<form id="test" name="test" method="post" role="form"><div id="testPanel" class="m-2 p-2 panel"><div class="panel-body"><div class="row"><div class="col-lg-12 col-md-12 col-sm-12 col"><div class="form-group"><div class="d-flex"><label class="form-group me-auto mr-auto">test label</label></div>test content</div></div></div></div></div></form>',
            $this->tabAndEolRemove((string) $Form)
        );
    }
    
    public function testFormAddCellAndCommands(): void
    {        
        $Form = new Form('test');
        $Form->getPanel()->addColumn()->push('test label', 'test content');
        $Form->setCommand();
        $this->assertEquals(
            '<form id="test" name="test" method="post" role="form"><div id="testPanel" class="m-2 p-2 panel"><div class="panel-body"><div class="row"><div class="col-lg-12 col-md-12 col-sm-12 col"><div class="form-group"><div class="d-flex"><label class="form-group me-auto mr-auto">test label</label></div>test content</div></div></div></div></div><div class="d-flex mt-2" style=""><div class="p-1 me-auto mr-auto"><button id="btn_back" name="btn_back" type="button" class="btn command-back btn-secondary"><span class="fa fa-arrow-left"></span> Indietro</button></div><div class="p-1"><button id="btn_save" name="btn_save" type="button" class="btn btn-primary click-execute" data-action="save"><span class="fa fa-floppy-o"></span> Salva</button></div></div></form>',
            $this->tabAndEolRemove((string) $Form)
        );
    }
}

