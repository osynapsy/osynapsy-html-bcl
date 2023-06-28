<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Osynapsy\Bcl5\ButtonGroup;
require_once 'StringClean.php';

final class ButtonGroupTest extends TestCase
{
    use StringClean;
    
    public function testButtonGroup(): void
    {
        $ButtonGroup = new ButtonGroup('test', 'Test');
        $this->assertEquals(
            '<div id="test" class="btn-group">'
            . '<button id="btn1test" name="btn1test" type="button" class="btn">Test</button>'
            . '<button id="btn2test" name="btn2test" type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expandend="false"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>'
            . '<ul id="dropdown-menu"></ul>'
            . '</div>',
            $this->tabAndEolRemove((string) $ButtonGroup)
        );
    }

    public function testButtonGroupDisabled(): void
    {
        $ButtonGroup = new ButtonGroup('test', 'Test');
        $ButtonGroup->setDisabled(true);
        $this->assertEquals(
            '<div id="test" class="btn-group" disabled="disabled">'
            . '<button id="btn1test" name="btn1test" type="button" class="btn">Test</button>'
            . '<button id="btn2test" name="btn2test" type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expandend="false"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>'
            . '<ul id="dropdown-menu"></ul>'
            . '</div>',
            $this->tabAndEolRemove((string) $ButtonGroup)
        );
    }

    public function testButtonGroupWithAction(): void
    {
        $ButtonGroup = new ButtonGroup('test', 'Test');
        $ButtonGroup->setAction('test', ['#p1', 'value']);
        $this->assertEquals(
            '<div id="test" class="btn-group click-execute" data-action="test" data-action-parameters="#p1,value">'
            . '<button id="btn1test" name="btn1test" type="button" class="btn">Test</button>'
            . '<button id="btn2test" name="btn2test" type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expandend="false"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>'
            . '<ul id="dropdown-menu"></ul>'
            . '</div>',
            $this->tabAndEolRemove((string) $ButtonGroup)
        );
    }
}
