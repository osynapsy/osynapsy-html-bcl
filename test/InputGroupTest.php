<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Osynapsy\Bcl\InputGroup;
require_once 'StringClean.php';

final class InputGroupTest extends TestCase
{
    use StringClean;
    
    public function testInputGroup(): void
    {
        $InputGroup = new InputGroup('test');
        $this->assertEquals(
            '<div class="input-group"><input id="test" type="text" name="test" class="form-control" aria-describedby="test_prefix"></div>',
            $this->tabAndEolRemove((string) $InputGroup)
        );
    }
}

