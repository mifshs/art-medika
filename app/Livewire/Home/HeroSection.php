<?php

namespace App\Livewire\Home;

use Livewire\Component;

class HeroSection extends Component
{
    public $title = "Ваше здоровье — наша забота";
    public $subtitle = "Медико-косметологический центр с современным оборудованием и опытными специалистами";
    public $stats = [
        ['number' => '20', 'label' => 'лет опыта работы в сфере медицины'],
        ['number' => '20', 'label' => 'видов медицинских направлений деятельности'],
        ['number' => '40+', 'label' => 'квалифицированных специалистов'],
    ];
    public $backgroundImage = '/images/clinic/hero-doctor-consultation.jpg';

    public function render()
    {
        return view('livewire.home.hero-section');
    }
}
