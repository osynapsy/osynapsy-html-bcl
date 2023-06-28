<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Osynapsy\Bcl5\Alert;
require_once 'StringClean.php';

final class AlertTest extends TestCase
{
    use StringClean;

    public function testAlert(): void
    {
        $Alert = new Alert('alert','alert message');
        $this->assertEquals(
            '<div id="alert_container" class="alert alert-info" role="alert"><input id="alert" type="hidden" name="alert" value="0"><span id="alert_label">alert message</span></div>',
            $this->tabAndEolRemove((string) $Alert)
        );
    }

    public function testAlertDanger(): void
    {
        $Alert = new Alert('alert', 'alert danger', Alert::ALERT_DANGER);        
        $this->assertEquals(
            '<div id="alert_container" class="alert alert-danger" role="alert"><input id="alert" type="hidden" name="alert" value="0"><span id="alert_label">alert danger</span></div>',
            $this->tabAndEolRemove((string) $Alert)
        );
    }

    public function testAlertDismissible(): void
    {        
        $Alert = new Alert('alert', 'alert dismissible');
        $Alert->setDismissible(true);
        $this->assertEquals(
            '<div id="alert_container" class="alert alert-info alert-dismissible text-center" role="alert"><input id="alert" type="hidden" name="alert" value="0"><span id="alert_label">alert dismissible</span> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>',
            $this->tabAndEolRemove((string) $Alert)
        );
    }
}
