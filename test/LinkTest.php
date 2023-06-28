<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Osynapsy\Bcl5\Link;

final class LinkTest extends TestCase
{
    public function testLink(): void
    {
        $Link = new Link('test', '/test', 'Test');
        $this->assertEquals(
            '<a id="test" href="/test">Test</a>',
            (string) $Link
        );
    }

    public function testLinkConstructWithClass(): void
    {
        $Link = new Link('test', '/test',  'Test', 'testClass');
        $this->assertEquals(
            '<a id="test" href="/test" class="testClass">Test</a>',
            (string) $Link
        );
    }

    public function testLinkDisabled(): void
    {
        $Link = new Link('test', '/test', 'Test');
        $Link->setDisabled(true);
        $this->assertEquals(
            '<a id="test" href="javascript:void(0);" onclick="event.stopPropagation();" disabled="disabled">Test</a>',
            (string) $Link
        );
    }

    public function testLinkWithAction(): void
    {
        $Link = new Link('test', false, 'Test action');
        $Link->setAction('test', ['#p1', 'value']);
        $this->assertEquals(
            '<a id="test" href="javascript:void(0);" class="click-execute" data-action="test" data-action-parameters="#p1,value">Test action</a>',
            (string) $Link
        );
    }
    
    public function testLinkOpenInModalAction(): void
    {
        $Link = new Link('test', '/open-modal', 'Test modal');
        $Link->openInModal('test modal', '640px', '480px', true);
        $this->assertEquals(
            '<a id="test" href="/open-modal" class="openInModal post-data" title="test modal" modal-width="640px" modal-height="480px">Test modal</a>',
            (string) $Link
        );
    }
}
