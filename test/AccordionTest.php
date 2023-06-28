<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Osynapsy\Bcl5\Accordion;
require_once 'StringClean.php';

final class AccordionTest extends TestCase
{
    use StringClean;

    public function testAccordion(): void
    {
        $Accordion = new Accordion('accordion');
        $this->assertEquals(
            '<div id="accordion" class="accordion osy-panel-accordion" role="tablist"><input id="accordion" type="hidden" name="accordion" value="0"></div>',
            $this->tabAndEolRemove((string) $Accordion)
        );
    }

    public function testAccordionPanel(): void
    {
        $Accordion = new Accordion('accordion');
        $Accordion->addPanel('testPanel');
        $this->assertEquals(
            '<div id="accordion" class="accordion osy-panel-accordion" role="tablist"><input id="accordion" type="hidden" name="accordion" value="0"><div id="accordion_0" class="card"><div id="accordion_0_body" data-parent="#accordion" class="card-body collapse show"></div></div></div>',
            $this->tabAndEolRemove((string) $Accordion)
        );
    }
}
