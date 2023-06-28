<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Osynapsy\Bcl5\Button;

final class ButtonTest extends TestCase
{
    public function testButton(): void
    {
        $Button = new Button('test', 'Test');
        $this->assertEquals(
            '<button id="test" name="test" type="button" class="btn btn-primary">Test</button>',
            (string) $Button
        );
    }

    public function testButtonConstructWithClass(): void
    {
        $Button = new Button('test', 'Test', 'btn-secondary');
        $this->assertEquals(
            '<button id="test" name="test" type="button" class="btn btn-secondary">Test</button>',
            (string) $Button
        );
    }

    public function testButtonDisabled(): void
    {
        $Button = new Button('test', 'Test');
        $Button->setDisabled(true);
        $this->assertEquals(
            '<button id="test" name="test" type="button" class="btn btn-primary" disabled="disabled">Test</button>',
            (string) $Button
        );
    }

    public function testButtonWithAction(): void
    {
        $Button = new Button('test', 'Test');
        $Button->setAction('test', ['#p1', 'value']);
        $this->assertEquals(
            '<button id="test" name="test" type="button" class="btn btn-primary click-execute" data-action="test" data-action-parameters="#p1,value">Test</button>',
            (string) $Button
        );
    }
}
