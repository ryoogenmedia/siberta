<?php

namespace App\Livewire\Frontend\Service;

use App\Models\Berkas;
use App\Models\Mahasiswa;
use App\Models\Revision;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

class UploadBerkas extends Component
{
    use WithFileUploads;

    #[Title('Upload Berkas')]
    #[Layout('layouts.base-service')]

    public $kategoriBerkas;
    public $berkas;
    public $mahasiswaId;

    public Revision $revision;
    public $fileBerkas;
    public $typeBerkas;

    public function resetInfoRevision(){
        $this->reset('revision');
    }

    public function showRevision($revisionId){
        $berkas = Berkas::findOrFail($revisionId);

        if($berkas){
            $this->revision = $berkas->revision;
        }
    }

    public function checkFile($type){
        $mahasiswa = Mahasiswa::findOrFail($this->mahasiswaId);
        $berkas = Berkas::where('name_file', $type)->where('mahasiswa_id', $mahasiswa->id)->first();

        return $berkas;
    }

    public function updatedKategoriBerkas($category){
        $mahasiswa = Mahasiswa::findOrFail($this->mahasiswaId);
        $this->berkas = Berkas::query()
            ->where('mahasiswa_id', $mahasiswa->id)
            ->where('category', $category)
            ->get();
    }

    public function mount(){
        $akun = auth()->user();
        $mahasiswa = Mahasiswa::where('email', $akun->email)->firstOrFail();

        if($mahasiswa){
            $this->mahasiswaId = $mahasiswa->id;
        }
    }

    public function render()
    {
        return view('livewire.frontend.service.upload-berkas');
    }
}
