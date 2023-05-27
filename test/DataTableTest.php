<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Osynapsy\Bcl\DataTable;
require_once 'StringClean.php';

final class DataTableTest extends TestCase
{
    use StringClean;
    
    public function testDataTable(): void
    {
        $DataTable = new DataTable('test');
        $this->assertEquals(
            '<div id="test"><table class="table table-hover"><thead><tr></tr></thead><tbody></tbody></table></div>',
            $this->tabAndEolRemove((string) $DataTable)
        );
    }

    public function testDataTableAddDataset(): void
    {        
        $DataTable = new DataTable('test');
        $DataTable->setDataset([            
            ['col-1' => 'row-1-1', 'col-2' => 'row-1-2'],
            ['col-1' => 'row-2-1', 'col-2' => 'row-2-2']
        ]);
        $this->assertEquals(
            '<div id="test"><table class="table table-hover"><thead><tr></tr><th>col-1</th><th>col-2</th></thead><tbody><tr><td>row-1-1</td><td>row-1-2</td></tr><tr><td>row-2-1</td><td>row-2-2</td></tr></tbody></table></div>',
            $this->tabAndEolRemove((string) $DataTable)
        );
    }        
}

