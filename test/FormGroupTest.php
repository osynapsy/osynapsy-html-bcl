<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Osynapsy\Bcl\FormGroup;
require_once 'StringClean.php';

final class FormGroupTest extends TestCase
{
    use StringClean;

    public function testFormGroup(): void
    {
        $FormGroup = new FormGroup('<input type="text" name="testinput" value="2">','test label');
        $this->assertEquals(
            '<div class="form-group"><div class="d-flex"><label class="font-weight-500 text-nowrap me-auto mr-auto">test label</label></div><input type="text" name="testinput" value="2"></div>',
            $this->tabAndEolRemove((string) $FormGroup)
        );
    }   
}
