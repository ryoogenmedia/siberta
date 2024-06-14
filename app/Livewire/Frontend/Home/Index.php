<?php

namespace App\Livewire\Frontend\Home;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Index extends Component
{
    #[Layout('layouts.base-frontend')]
    #[Title('Home')]

    public $categoryDocument;

    public function render()
    {
        return view('livewire.frontend.home.index');
    }
}
