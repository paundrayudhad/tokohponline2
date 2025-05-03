<?php

namespace App\Livewire;

use Livewire\Component;

class PromoBanner extends Component
{
    public function lihatProduk()
    {
        return redirect()->route('product');
    }

    public function tukarSekarang()
    {
        return redirect()->away('#');
    }

    public function render()
    {
        return view('livewire.promo-banner');
    }
}
