<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BannerCarousel extends Component
{
    public array $banners;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->banners = [
            ['image' => asset('img/banner/banner2.jpg')],
            ['image' => asset('img/banner/banner3.jpg')],
            ['image' => asset('img/banner/banner4.jpg')],
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.banner-carousel', [
            'banners' => $this->banners,
        ]);
    }
}
