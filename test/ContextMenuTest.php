<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Osynapsy\Bcl\ContextMenu;
require_once 'StringClean.php';

final class ContextMenuTest extends TestCase
{
    use StringClean;
    
    public function testContextMenu(): void
    {
        $ContextMenu = new ContextMenu('test');
        $this->assertEquals(
            '<div id="test" class="BclContextMenu dropdown clearfix"><ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu" 0="style" 1="display: block; position: static; margin-bottom: 5px;"></ul></div>',
            $this->tabAndEolRemove((string) $ContextMenu)
        );
    }

    public function testContextMenuAddAction(): void
    {        
        $ContextMenu = new ContextMenu('test');
        $ContextMenu->addAction('action1', 'action1');
        $this->assertEquals(
            '<div id="test" class="BclContextMenu dropdown clearfix"><ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu" 0="style" 1="display: block; position: static; margin-bottom: 5px;"><li><a href="javascript:void(0);" data-action="action1" data-action-param="">action1</a></li></ul></div>',
            $this->tabAndEolRemove((string) $ContextMenu)
        );
    }        
}

