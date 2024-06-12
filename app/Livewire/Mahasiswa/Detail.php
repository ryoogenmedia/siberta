<?php

namespace App\Livewire\Mahasiswa;

use App\Models\Berkas;
use App\Models\Mahasiswa;
use Livewire\Component;
use ZipArchive;

class Detail extends Component
{
    public Mahasiswa $mahasiswa;

    public function checkFile($type){
        $berkas = Berkas::query()
            ->where('mahasiswa_id', $this->mahasiswa->id)
            ->where('name_file', $type)
            ->first();

        return $berkas;
    }

    public function downloadAllFile(){
        $zip = new ZipArchive;
        $fileName = 'berkas-laporan-mahasiswa' . '-[' . $this->mahasiswa->name . '].zip';
        $zipPath = storage_path('app/public/' . $fileName);

        if ($zip->open($zipPath, ZipArchive::CREATE) === TRUE) {

            foreach ($this->mahasiswa->berkas as $berkas) {
                if ($berkas->file) {
                    $berkasPath = storage_path('app/public/' . $berkas->file);
                    $extension = pathinfo($berkasPath, PATHINFO_EXTENSION);
                    if (file_exists($berkasPath)) {
                        $fileInZip =  $berkas->name_file . '.' . $extension;
                        $zip->addFile($berkasPath, $fileInZip);
                    }
                }
            }

            $zip->close();

            return response()->download($zipPath)->deleteFileAfterSend(true);
        } else {
            session()->flash('alert', [
                'type' => 'danger',
                'message' => 'Gagal membuat file ZIP.',
                'detail' => "Terjadi kesalahan saat membuat file ZIP.",
            ]);

            return back();
        }
    }

    public function mount($id){
        $this->mahasiswa = Mahasiswa::findOrFail($id);
    }

    public function render()
    {
        return view('livewire.mahasiswa.detail');
    }
}
