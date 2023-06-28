<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Osynapsy\Bcl5\Carousel;
require_once 'StringClean.php';

final class CarouselTest extends TestCase
{
    use StringClean;

    public function testCarousel(): void
    {
        $Carousel = new Carousel('carousel1');
        $this->assertEquals(
            '<div id="carousel1" class="carousel slide"><div class="carousel-inner"></div></div>',
            $this->tabAndEolRemove((string) $Carousel)
        );
    }

    public function testCarouselAddDiapositive(): void
    {
        $Carousel = new Carousel('carousel1');
        $Carousel->addSlide(['1', 'image1'], 'http://testurl');
        $this->assertEquals(
            '<div id="carousel1" class="carousel slide"><div class="carousel-inner"><div class="carousel-item active"><img class="d-block w-100 opacity-25" src="http://testurl"><div class="carousel-caption d-none d-md-block"><h5>1</h5><p>image1</p></div></div></div></div>',
            $this->tabAndEolRemove((string) $Carousel)
        );
    }
    
    public function testCarouselAddDiapositiveAndShowCommands(): void
    {
        $Carousel = new Carousel('carousel1', true);
        $Carousel->addSlide(['1', 'image1'], 'http://testurl');
        $this->assertEquals(
            '<div id="carousel1" class="carousel slide"><div class="carousel-inner"><div class="carousel-item active"><img class="d-block w-100 opacity-25" src="http://testurl"><div class="carousel-caption d-none d-md-block"><h5>1</h5><p>image1</p></div></div></div><button name="" type="button" class="carousel-control-prev" data-bs-target="#carousel1" data-bs-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="visually-hidden">prev</span></button><button name="" type="button" class="carousel-control-next" data-bs-target="#carousel1" data-bs-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="visually-hidden">next</span></button></div>',
            $this->tabAndEolRemove((string) $Carousel)
        );
    }
}
