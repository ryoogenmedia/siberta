<?php

namespace App\Livewire\Home;

use App\Helpers\HomeChart;
use App\Models\Berkas;
use Livewire\Component;

class Index extends Component
{
    public $revisi;
    public $menunggu;
    public $perbaikan;
    public $disetujui;

    public $jmlRevisi;
    public $jmlMenunggu;
    public $jmlPerbaikan;
    public $jmlDisetujui;

    public function berkas($status){
        return Berkas::where('status_file', $status)->count();
    }

    public function mount(){
        $this->revisi = HomeChart::REVISION();
        $this->menunggu = HomeChart::PENDDING();
        $this->perbaikan = HomeChart::REVISED();
        $this->disetujui = HomeChart::APPROVE();

        $this->jmlRevisi = $this->berkas('revision');
        $this->jmlDisetujui = $this->berkas('approve');
        $this->jmlMenunggu = $this->berkas('pending');
        $this->jmlPerbaikan = $this->berkas('revised');
    }

    public function render()
    {
        return view('livewire.home.index');
    }
}
