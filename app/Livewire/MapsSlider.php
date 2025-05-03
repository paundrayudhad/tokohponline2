<?php

namespace App\Livewire;

use Livewire\Component;

class MapsSlider extends Component
{
    public $tokos = [];
    public $selectedMapUrl = null;
    public $activeSlideIndex = 0;
    public $maps_url = null;

    public function mount()
    {
        $this->loadStoreData();
    }

    protected function loadStoreData()
    {
        $this->tokos = [
            [
                'nama' => 'Moora Phone Cell Banjarbaru',
                'foto' => 'maps/syihab-banjarbaru.jpg',
                'maps_embed' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3976.991835973597!2d114.8314020749936!3d-3.443148096398634!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2de681006acad60d%3A0x4a8c5e9857e848dc!2sSyihab%20Store%20Banjarbaru!5e0!3m2!1sid!2sid!4v1713600000000!5m2!1sid!2sid',
                'maps_url' => 'https://maps.app.goo.gl/5RCS2ExbRsNsBRWw5',
            ],
            [
                'nama' => 'Syihab Premium Banjarbaru',
                'foto' => 'maps/syihab-premium.jpg',
                'maps_embed' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3982.619091584223!2d114.8222568!3d-3.4424638!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2de68101c9cf4789%3A0x1755ad7996469ce6!2sSYIHAB%20PHONE%20PREMIUM!5e0!3m2!1sid!2sid!4v1745156145653!5m2!1sid!2sid',
                'maps_url' => 'https://maps.app.goo.gl/HtfhVy52MB4qafvYA',
            ],
            [
                'nama' => 'Moora Phone Cell Martapura',
                'foto' => 'maps/syihab-martapura.jpg',
                'maps_embed' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3982.714519200973!2d114.85009889999999!3d-3.4195655!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2de68112ee6a0009%3A0xa60c9592afdd3113!2sSyihab%20Martapura!5e0!3m2!1sid!2sid!4v1745156196884!5m2!1sid!2sid',
                'maps_url' => 'https://maps.app.goo.gl/LkqC2Z7Mk6hb2dEt7',
            ],
            [
                'nama' => 'Moora Phone Cell Veteran',
                'foto' => 'maps/syihab-veteran.jpg',
                'maps_embed' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3983.1228275011626!2d114.61017419999999!3d-3.319809!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2de423ce06af5be5%3A0xf20b998f9b3cdab1!2sSyihab%20Phone%20Veteran%20Banjarmasin!5e0!3m2!1sid!2sid!4v1745156257064!5m2!1sid!2sid',
                'maps_url' => 'https://maps.app.goo.gl/LCwc33v6YzGCUx2x7',
            ],
            [
                'nama' => 'Moora Phone Cell Sultan Adam',
                'foto' => 'maps/syihab-sultan-adam.jpg',
                'maps_embed' => 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d31865.891407386065!2d114.5597053!3d-3.2915181!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2de423002be8d1bb%3A0xf2bac97bba509efa!2sSyihab%20Store%20Sudam!5e0!3m2!1sid!2sid!4v1745156303408!5m2!1sid!2sid',
                'maps_url' => 'https://maps.app.goo.gl/92G3qtZK53NMjuFBA',
            ],
        ];
    }

    public function showMap($index)
    {
        if (isset($this->tokos[$index])) {
            $this->selectedMapUrl = $this->tokos[$index]['maps_embed'];
            $this->activeSlideIndex = $index;
            $this->maps_url = $this->tokos[$index]['maps_url'];
            $this->dispatch('map-shown'); // Event untuk tracking jika diperlukan
        }
    }

    public function closeMap()
    {
        $this->selectedMapUrl = null;
    }

    public function render()
    {
        return view('livewire.maps-slider');
    }
}
