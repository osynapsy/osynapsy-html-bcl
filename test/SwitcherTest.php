<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Osynapsy\Bcl5\Switcher;
require_once 'StringClean.php';

final class SwitcherTest extends TestCase
{
    use StringClean;

    public function testSwitcher(): void
    {
        $Switcher = new Switcher('test','testLabel');
        $this->assertEquals(
            '<div id="test_container" class="custom-control custom-switch"><input id="test" type="hidden" name="test" value="0"><input id="test" type="checkbox" name="test" value="1" class="custom-control-input"><label class="custom-control-label" for="test">testLabel</label></div>',
            $this->tabAndEolRemove((string) $Switcher)
        );
    }

    public function testSwitcherDisabled(): void
    {
        $Switcher = new Switcher('test', 'testLabel');
        $Switcher->setDisabled(true);
        $this->assertEquals(
            '<div id="test_container" class="custom-control custom-switch"><input id="test" type="hidden" name="test" value="0"><input id="test" type="checkbox" name="test" value="1" class="custom-control-input" disabled="disabled"><label class="custom-control-label" for="test">testLabel</label></div>',
            $this->tabAndEolRemove((string) $Switcher)
        );
    }

    public function testSwitcherChecked(): void
    {
        $_REQUEST['chkTest'] = '1';
        $Switcher = new Switcher('test', 'testLabel');
        $Switcher->setChecked(($_REQUEST['chkTest'] === '1'));
        $this->assertEquals(
            '<div id="test_container" class="custom-control custom-switch"><input id="test" type="hidden" name="test" value="0"><input id="test" type="checkbox" name="test" value="1" class="custom-control-input" checked="checked"><label class="custom-control-label" for="test">testLabel</label></div>',
            $this->tabAndEolRemove((string) $Switcher)
        );
    }
}
