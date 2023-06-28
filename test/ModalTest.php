<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Osynapsy\Bcl5\Modal;
require_once 'StringClean.php';

final class ModalTest extends TestCase
{
    use StringClean;
    
    public function testModal(): void
    {
        $Modal = new Modal('test');
        $this->assertEquals(
            '<div id="test" class="modal fade" tabindex="-1" role="dialog"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><h5 class="modal-title"></h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body"></div><div class="modal-footer"></div></div></div></div>',
            $this->tabAndEolRemove((string) $Modal)
        );
    }
}

