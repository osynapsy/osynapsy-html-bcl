<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Osynapsy\Bcl5\TextBox;
//require_once 'StringClean.php';

final class TextBoxTest extends TestCase
{
    public function testTextBox(): void
    {
        $TextBox = new TextBox('test');
        $this->assertEquals(
            '<input id="test" type="text" name="test" class="form-control">',
            (string) $TextBox
        );
    }

    public function testTextBoxValue(): void
    {        
        $TextBox = new TextBox('textBoxTest');
        $TextBox->setValue('hello word!');
        $this->assertEquals(
            '<input id="textBoxTest" type="text" name="textBoxTest" class="form-control" value="hello word!">',
            (string) $TextBox
        );
    }

    public function testTextBoxWithAction(): void
    {
        $TextBox = new TextBox('test');
        $TextBox->setAction('test', ['#p1','value']);
        $this->assertEquals(
            '<input id="test" type="text" name="test" class="form-control change-execute" data-action="test" data-action-parameters="#p1,value">',
            (string) $TextBox
        );
    }
}

