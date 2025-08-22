<?php

namespace App\Livewire;

use Livewire\Component;

class CarouselForHomepage extends Component
{

    public $slides = [
        [
            '/images/slide1.jpg',
            '/images/slide2.png',
        ],
        [
            '/images/slide3.jpg',
            '/images/slide1.jpg',
        ],
        [
            '/images/slide2.png',
            '/images/slide3.jpg',
        ],
    ];

    public $currentSlide = 0;

    public function next()
    {
        $this->currentSlide = ($this->currentSlide + 1) % count($this->slides);
    }

    public function previous()
    {
        $this->currentSlide = ($this->currentSlide - 1 + count($this->slides)) % count($this->slides);
    }

    public function render()
    {
        return view('livewire.carousel-for-homepage');
    }
}
