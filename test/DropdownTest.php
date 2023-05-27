<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Osynapsy\Bcl\Dropdown;
use Osynapsy\Bcl\Link;
require_once('StringClean.php');

final class DropdownTest extends TestCase
{
    use StringClean;
    
    public function testDropdown(): void
    {
        $Dropdown = new Dropdown('test', 'Test');
        $this->assertEquals(
            '<div class="dropdown"><button id="test_btn" name="test_btn" type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Test</button><div class="dropdown-menu dropdown-menu-left" aria-labelledby="test_btn"></div></div>',
            $this->tabAndEolRemove((string) $Dropdown)
        );
    }

    public function testDropdownConstructWithClass(): void
    {
        $Dropdown = new Dropdown('test', 'Test', Dropdown::ALIGN_RIGHT);
        $this->assertEquals(
            '<div class="dropdown"><button id="test_btn" name="test_btn" type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Test</button><div class="dropdown-menu dropdown-menu-right" aria-labelledby="test_btn"></div></div>',
            $this->tabAndEolRemove((string) $Dropdown)
        );
    }

    public function testDropdownDisabled(): void
    {
        $Dropdown = new Dropdown('test', 'Test');
        $Dropdown->setDisabled(true);
        $this->assertEquals(
            '<div class="dropdown"><button id="test_btn" name="test_btn" type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" disabled="disabled">Test</button><div class="dropdown-menu dropdown-menu-left" aria-labelledby="test_btn"></div></div>',
             $this->tabAndEolRemove((string) $Dropdown)
        );
    }

    public function testDropdownWithAction(): void
    {
        $Dropdown = new Dropdown('test', 'Test');
        $Dropdown->setDataset([new Link('item1', '#', '')]);
        $this->assertEquals(
            '<div class="dropdown"><button id="test_btn" name="test_btn" type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Test</button><div class="dropdown-menu dropdown-menu-left" aria-labelledby="test_btn"><a id="item1" href="#" class="dropdown-item"></a></div></div>',
            $this->tabAndEolRemove((string) $Dropdown)
        );
    }
}
