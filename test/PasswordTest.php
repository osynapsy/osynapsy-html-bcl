<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Osynapsy\Bcl\PasswordBox;
//require_once 'StringClean.php';

final class PasswordTest extends TestCase
{
    public function testPassword(): void
    {
        $TextBox = new PasswordBox('test');
        $this->assertEquals(
            '<input id="test" type="password" name="test" autocomplete="off" class="form-control">',
            (string) $TextBox
        );
    }

    public function testPasswordBoxValue(): void
    {        
        $TextBox = new PasswordBox('textBoxTest');
        $TextBox->setValue('hello word!');
        $this->assertEquals(
            '<input id="textBoxTest" type="password" name="textBoxTest" autocomplete="off" class="form-control" value="hello word!">',
            (string) $TextBox
        );
    }

    public function testPasswordBoxWithAction(): void
    {
        $TextBox = new PasswordBox('test');
        $TextBox->setAction('test', ['#p1','value']);
        $this->assertEquals(
            '<input id="test" type="password" name="test" autocomplete="off" class="form-control change-execute" data-action="test" data-action-parameters="#p1,value">',
            (string) $TextBox
        );
    }
}

