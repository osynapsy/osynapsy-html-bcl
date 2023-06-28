<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Osynapsy\Bcl5\Tab;
require_once 'StringClean.php';

final class TabTest extends TestCase
{
    use StringClean;
    
    public function testTab(): void
    {
        $Tab = new Tab('test');
        $this->assertEquals(
            '<div><input id="test" type="hidden" name="test"><ul id="test_nav" class="nav nav-tabs mt-1" role="tablist" data-tabs="tabs"></ul><div class="tab-content p-2 bg-white border-left border-right border-bottom"></div></div>',
            $this->tabAndEolRemove((string) $Tab)
        );
    }
}

