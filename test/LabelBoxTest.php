<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Osynapsy\Bcl5\LabelBox;
require_once 'StringClean.php';

final class LabelBoxTest extends TestCase
{
    use StringClean;
    
    public function testLabelBox(): void
    {
        $LabelBox = new LabelBox('test');
        $this->assertEquals(
            '<div id="test_labelbox" class="osynapsy-labelbox"><input id="test" type="hidden" name="test"><span></span></div>',
            $this->tabAndEolRemove((string) $LabelBox)
        );
    }

    public function testLabelBoxValue(): void
    {        
        $LabelBox = new LabelBox('test');
        $LabelBox->setValue('hello word!');
        $this->assertEquals(
            '<div id="test_labelbox" class="osynapsy-labelbox"><input id="test" type="hidden" name="test" value="hello word!"><span>hello word!</span></div>',
            $this->tabAndEolRemove((string) $LabelBox)
        );
    }

    public function testLabelBoxWithAction(): void
    {
        $LabelBox = new LabelBox('test');
        $LabelBox->setLabel('hello word!');
        $LabelBox->setValue('1');
        $this->assertEquals(
            '<div id="test_labelbox" class="osynapsy-labelbox"><input id="test" type="hidden" name="test" value="1"><span>hello word!</span></div>',
            $this->tabAndEolRemove((string) $LabelBox)
        );
    }
}

