<?php

namespace App\Livewire\Frontend\Service;

use App\Models\Berkas;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use ZipArchive;

class LihatBerkas extends Component
{
    #[Title('Upload Berkas')]
    #[Layout('layouts.base-service')]

    public $idBerkas;
    public Berkas $berkas;

    public function mount($idBerkas){
        $this->idBerkas = $idBerkas;
        $this->berkas = Berkas::where('code_document', $idBerkas)->firstOrFail();
    }

    public function downloadSurat(){
        if($this->berkas->exam_letter && Storage::disk('public')->exists($this->berkas->exam_letter)){
            $zip = new ZipArchive;
            $fileName = '[ ' . $this->berkas->mahasiswa->name . ' ]-Surat Ujian-' . $this->berkas->category . '.zip';
            $zipPath = storage_path('app/public/' . $fileName);

            if ($zip->open($zipPath, ZipArchive::CREATE) === TRUE) {

                $berkasPath = storage_path('app/public/' . $this->berkas->exam_letter);
                if (file_exists($berkasPath)) {
                    $extension = pathinfo($berkasPath, PATHINFO_EXTENSION);
                    $fileInZip = '[ ' . $this->berkas->mahasiswa->name . ' ]-Surat Ujian-' . $this->berkas->category . '.' . $extension;
                    $zip->addFile($berkasPath, $fileInZip);
                }

                $zip->close();

                return response()->download($zipPath)->deleteFileAfterSend(true);
            }else{
                session()->flash('alert', [
                    'type' => 'danger',
                    'message' => 'Gagal.',
                    'detail' => "file surat ujian mahasiswa tidak ditemukan.",
                ]);

                return back();
            }
        }
    }

    public function downloadFile(){
        if($this->berkas->file && Storage::disk('public')->exists($this->berkas->file)){
            $zip = new ZipArchive;
            $fileName = '[ ' . $this->berkas->mahasiswa->name . ' ]-' . $this->berkas->name_file . '.zip';
            $zipPath = storage_path('app/public/' . $fileName);

            if ($zip->open($zipPath, ZipArchive::CREATE) === TRUE) {

                $berkasPath = storage_path('app/public/' . $this->berkas->file);
                if (file_exists($berkasPath)) {
                    $extension = pathinfo($berkasPath, PATHINFO_EXTENSION);
                    $fileInZip = '[ ' . $this->berkas->mahasiswa->name . ' ]-' . $this->berkas->name_file . '.' . $extension;
                    $zip->addFile($berkasPath, $fileInZip);
                }

                $zip->close();

                return response()->download($zipPath)->deleteFileAfterSend(true);
            }else{
                session()->flash('alert', [
                    'type' => 'danger',
                    'message' => 'Gagal.',
                    'detail' => "file berkas mahasiswa tidak ditemukan.",
                ]);

                return back();
            }
        }
    }

    public function render()
    {
        return view('livewire.frontend.service.lihat-berkas');
    }
}
