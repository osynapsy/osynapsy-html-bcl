<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Osynapsy\Bcl\FileBox;
require_once 'StringClean.php';

final class FileBoxTest extends TestCase
{
    use StringClean;
    
    public function testFileBox(): void
    {
        $FileBox = new FileBox('test');
        $this->assertEquals(
            '<span></span><div class="input-group"><span class="input-group-btn input-group-prepend"><span class="btn btn-primary btn-file"><input type="file" name="test"><span class="fa fa-folder-open"></span></span></span><input type="text" class="form-control" readonly></div>',
            $this->tabAndEolRemove((string) $FileBox)
        );
    }   
}

