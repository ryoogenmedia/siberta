<?php

namespace App\Livewire\Frontend\Service;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class UploadBerkas extends Component
{
    #[Title('Upload Berkas')]
    #[Layout('layouts.base-service')]

    public function render()
    {
        return view('livewire.frontend.service.upload-berkas');
    }
}
