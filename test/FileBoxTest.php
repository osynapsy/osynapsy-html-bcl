<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Osynapsy\Bcl5\FileBox;
require_once 'StringClean.php';

final class FileBoxTest extends TestCase
{
    use StringClean;
    
    public function testFileBox(): void
    {
        $FileBox = new FileBox('test');
        $this->assertEquals(
            '<div id="test_container" class="bcl-filebox"><input id="test" type="hidden" name="test"><div class="input-group"><button id="test-send" name="test-send" type="button" class="btn btn-outline-primary bcl-filebox-send d-none click-execute" data-action="upload" data-action-parameters="test">Invia</button><input type="text" name="" class="form-control" readonly="readonly"><input id="test_file" type="file" name="test_file" class="d-none"><label class="input-group-text btn btn-outline-primary btn-file" for="test_file">...</label></div></div>',
            $this->tabAndEolRemove((string) $FileBox)
        );
    }   
}

