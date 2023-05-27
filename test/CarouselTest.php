<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Osynapsy\Bcl\Carousel;
require_once 'StringClean.php';

final class CarouselTest extends TestCase
{
    use StringClean;

    public function testCarousel(): void
    {
        $Carousel = new Carousel('carousel1');
        $this->assertEquals(
            '<div id="carousel1"><div class="carousel-inner"></div></div>',
            $this->tabAndEolRemove((string) $Carousel)
        );
    }

    public function testCarouselAddDiapositive(): void
    {
        $Carousel = new Carousel('carousel1');
        $Carousel->setDataset([['1', 'image1', 'http://testurl']]);
        $this->assertEquals(
            '<div id="carousel1"><div class="carousel-inner"><div class="active"><img class="d-block w-100" src="http://testurl"></div></div></div>',
            $this->tabAndEolRemove((string) $Carousel)
        );
    }
    
    public function testCarouselAddDiapositiveAndShowCommands(): void
    {
        $Carousel = new Carousel('carousel1', true);
        $Carousel->setDataset([['1', 'image1', 'http://testurl']]);        
        $this->assertEquals(
            '<div id="carousel1"><div class="carousel-inner"><div class="active"><img class="d-block w-100" src="http://testurl"></div><a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="sr-only">prev</span></a><a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="prev"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="sr-only">next</span></a></div></div>',
            $this->tabAndEolRemove((string) $Carousel)
        );
    }
}
