<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Osynapsy\Bcl\Card;
require_once 'StringClean.php';

final class CardTest extends TestCase
{
    use StringClean;

    public function testCard(): void
    {
        $Card = new Card('card1', 'card');
        $this->assertEquals(
            '<div id="card1" class="card"><div class="card-body"></div></div>',
            $this->tabAndEolRemove((string) $Card)
        );
    }

    public function testCardAddColumn(): void
    {
        $Card = new Card('card1');
        $Card->addColumn()->push('test label', 'test content');
        $this->assertEquals(
            '<div id="card1" class="card"><div class="card-body"><div class="row" length="12"><div class="col-lg-12 col-md-12 col-sm-12 col"><div class="form-group"><div class="d-flex"><label class="form-group mr-auto">test label</label></div>test content</div></div></div></div></div>',
            $this->tabAndEolRemove((string) $Card)
        );
    }
}
