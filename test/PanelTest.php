<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Osynapsy\Bcl5\Panel;
require_once 'StringClean.php';

final class PanelTest extends TestCase
{
    use StringClean;

    public function testPanel(): void
    {
        $Panel = new Panel('panel1');
        $this->assertEquals(
            '<div id="panel1" class="panel"><div class="panel-body"></div></div>',
            $this->tabAndEolRemove((string) $Panel)
        );
    }

    public function testPanelAddColumn(): void
    {
        $Panel = new Panel('Panel1');
        $Panel->addColumn()->push('test label', 'test content');
        $this->assertEquals(
            '<div id="Panel1" class="panel"><div class="panel-body"><div class="row mb-4"><div class="col-lg-12 col-md-12 col-sm-12 col"><div class="form-group"><div class="d-flex"><label class="form-group me-auto mr-auto">test label</label></div>test content</div></div></div></div></div>',
            $this->tabAndEolRemove((string) $Panel)
        );
    }
}
