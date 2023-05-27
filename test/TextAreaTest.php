<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Osynapsy\Bcl\TextArea;
require_once 'StringClean.php';

final class TextAreaTest extends TestCase
{
    public function testTextArea(): void
    {
        $TextArea = new TextArea('test');
        $this->assertEquals(
            '<textarea id="test" name="test" class="form-control"></textarea>',
            (string) $TextArea
        );
    }

    public function testTextAreaValue(): void
    {        
        $TextArea = new TextArea('textAreaTest');
        $TextArea->setValue('hello word!');
        $this->assertEquals(
            '<textarea id="textAreaTest" name="textAreaTest" class="form-control">hello word!</textarea>',
            (string) $TextArea
        );
    }

    public function testTextAreaWithAction(): void
    {
        $TextArea = new TextArea('test');
        $TextArea->setAction('test', ['#p1', 'value']);
        $this->assertEquals(
            '<textarea id="test" name="test" class="form-control change-execute" data-action="test" data-action-parameters="#p1,value"></textarea>',
            (string) $TextArea
        );
    }
}

