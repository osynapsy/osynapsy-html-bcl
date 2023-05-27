<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Osynapsy\Bcl\Column;

final class ColumnTest extends TestCase
{
    public function testColumn(): void
    {
        $Column = new Column();
        $this->assertEquals(
            '<div class="col-lg-2 col-md-2 col-sm-2 col"></div>',
            (string) $Column
        );
    }

    public function testColumnSetLgWidth(): void
    {
        $Column = new Column(12);
        $this->assertEquals(
            '<div class="col-lg-12 col-md-12 col-sm-12 col"></div>',
            (string) $Column
        );
    }   
}
