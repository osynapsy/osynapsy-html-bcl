<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Osynapsy\Bcl\CheckBox;
require_once 'StringClean.php';

final class CheckBoxTest extends TestCase
{
    use StringClean;

    public function testCheckBox(): void
    {
        $CheckBox = new CheckBox('test','testLabel');
        $this->assertEquals(
            '<label id="test_container" class="form-check-label"><input type="hidden" name="test" value="0"><input id="test" type="checkbox" name="test" value="1">&nbsp;testLabel</label>',
            $this->tabAndEolRemove((string) $CheckBox)
        );
    }

    public function testCheckBoxDisabled(): void
    {
        $CheckBox = new CheckBox('test', 'testLabel');
        $CheckBox->setDisabled(true);
        $this->assertEquals(
            '<label id="test_container" class="form-check-label"><input type="hidden" name="test" value="0"><input id="test" type="checkbox" name="test" value="1" disabled="disabled">&nbsp;testLabel</label>',
            $this->tabAndEolRemove((string) $CheckBox)
        );
    }

    public function testCheckBoxChecked(): void
    {
        $_REQUEST['chkTest'] = '1';
        $CheckBox = new CheckBox('test', 'testLabel');
        $CheckBox->setChecked(($_REQUEST['chkTest'] === '1'));
        $this->assertEquals(
            '<label id="test_container" class="form-check-label"><input type="hidden" name="test" value="0"><input id="test" type="checkbox" name="test" value="1" checked="checked">&nbsp;testLabel</label>',
            $this->tabAndEolRemove((string) $CheckBox)
        );
    }
}
